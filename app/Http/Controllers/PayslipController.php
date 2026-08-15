<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payslip;
use App\Models\Attendance;
use App\Models\AuditLog;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayslipController extends Controller
{
    public function index(Request $request)
    {
        $selectedMonth = $request->get('month', now()->format('Y-m'));

        $payslips = Payslip::with(['employee.attendances' => function ($query) use ($selectedMonth) {
            $query->where('date', 'like', $selectedMonth . '-%');
        }])
            ->where('month', $selectedMonth)
            ->get();

        $employees = Employee::orderBy('name')->get();
        $attendanceRequest = \App\Models\AttendanceRequest::where('month', $selectedMonth)->first();

        return view('payslips.index', compact('payslips', 'employees', 'selectedMonth', 'attendanceRequest'));
    }

    public function generate(Request $request)
    {
        if (Auth::user()->isOwner()) {
            abort(403, 'Owner tidak dapat men-generate slip gaji.');
        }

        $request->validate([
            'month' => 'required|string|regex:/^\d{4}-\d{2}$/',
            'deduction_per_absent' => 'required|numeric|min:0',
            'employee_id' => 'nullable|string',
        ]);

        $month = $request->month;
        $deductionRate = $request->deduction_per_absent;

        // Validate that attendance data has been provided by HRD
        $attReq = \App\Models\AttendanceRequest::where('month', $month)->first();
        if (!$attReq || $attReq->status !== 'provided') {
            return back()->with('error', 'Gagal memproses slip gaji. HRD belum menyerahkan/menyetujui absensi untuk bulan ' . $month . '.');
        }

        $employeeQuery = Employee::with(['attendances' => function ($query) use ($month) {
            $query->where('date', 'like', $month . '-%');
        }]);

        if ($request->filled('employee_id') && $request->employee_id !== 'all') {
            $employeeQuery->where('id', $request->employee_id);
        }

        $employees = $employeeQuery->get();

        if ($employees->isEmpty()) {
            return back()->with('error', 'Tidak ada karyawan terpilih untuk di-generate slip gajinya.');
        }

        foreach ($employees as $employee) {
            // Count unexcused absences ("absent" status)
            $absentCount = $employee->attendances->where('status', 'absent')->count();
            
            // Sum overtime hours
            $overtimeHours = $employee->attendances->sum('overtime_hours');
            $overtimeRate = 50000; // Rp 50.000 per hour
            $overtimeBonus = $overtimeHours * $overtimeRate;

            $baseSalary = $employee->base_salary;
            $allowance = $employee->allowance;
            $deductions = $absentCount * $deductionRate;
            $netSalary = max(0, $baseSalary + $allowance + $overtimeBonus - $deductions);

            Payslip::updateOrCreate(
                [
                    'employee_id' => $employee->id,
                    'month' => $month,
                ],
                [
                    'base_salary' => $baseSalary,
                    'allowance' => $allowance,
                    'deductions' => $deductions,
                    'overtime_bonus' => $overtimeBonus,
                    'net_salary' => $netSalary,
                    'status' => 'draft',
                ]
            );
        }

        AuditLog::log('Generate Payslips', 'Generated payslips for month ' . $month . ' with deduction rate Rp ' . number_format($deductionRate, 0, ',', '.'));

        return redirect()->route('payslips.index', ['month' => $month])->with('success', 'Slip gaji berhasil di-generate.');
    }

    public function pay(Payslip $payslip)
    {
        if (Auth::user()->isOwner()) {
            abort(403, 'Owner tidak dapat melakukan pembayaran gaji.');
        }

        $payslip->update(['status' => 'paid']);

        // Find or create 'Gaji Karyawan' category
        $category = Category::firstOrCreate(
            ['name' => 'Gaji Karyawan', 'type' => 'expense']
        );

        // Record a transaction for this payslip payment
        Transaction::create([
            'category_id' => $category->id,
            'type' => 'expense',
            'amount' => $payslip->net_salary,
            'description' => 'Pembayaran Gaji ' . $payslip->employee->name . ' - Bulan ' . $payslip->month,
            'date' => now()->format('Y-m-d'),
            'user_id' => Auth::id(),
        ]);

        AuditLog::log('Pay Payslip', 'Paid salary to ' . $payslip->employee->name . ' for month ' . $payslip->month . ' of Rp ' . number_format($payslip->net_salary, 0, ',', '.'));

        return back()->with('success', 'Status slip gaji diubah menjadi PAID dan dicatat di Pengeluaran.');
    }

    public function show(Payslip $payslip)
    {
        // Authorize Karyawan to only view their own payslip
        $user = Auth::user();
        if ($user->isKaryawan()) {
            $employee = Employee::where('user_id', $user->id)->first();
            if (!$employee || $employee->id !== $payslip->employee_id) {
                abort(403, 'Anda tidak diizinkan melihat slip gaji ini.');
            }
        }

        return view('payslips.show', compact('payslip'));
    }
}

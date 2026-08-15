<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $selectedDate = $request->input('date', now()->format('Y-m-d'));
        $selectedEmployeeId = $request->input('employee_id');

        $employees = Employee::with(['user', 'attendances'])->orderBy('name')->get();
        
        // Find users who are role='karyawan' and don't have an employee profile yet
        $availableUsers = User::where('role', 'karyawan')
            ->whereDoesntHave('employee')
            ->get();

        // Get recent attendances
        $recentAttendances = Attendance::with('employee')
            ->orderBy('date', 'desc')
            ->limit(20)
            ->get();

        // Filter the employees for the attendance list if a specific employee is selected
        $attendanceEmployees = $employees;
        if ($selectedEmployeeId) {
            $attendanceEmployees = $employees->where('id', $selectedEmployeeId);
        }

        return view('employees.index', compact('employees', 'attendanceEmployees', 'availableUsers', 'recentAttendances', 'selectedDate', 'selectedEmployeeId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'base_salary' => 'required|numeric|min:0',
            'allowance' => 'required|numeric|min:0',
            'create_user' => 'nullable|boolean',
            'email' => 'required_if:create_user,1|nullable|email|unique:users,email',
            'password' => 'required_if:create_user,1|nullable|string|min:6',
            'user_id' => 'required_unless:create_user,1|nullable|exists:users,id',
        ]);

        $userId = $request->user_id;

        if ($request->create_user) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'karyawan',
            ]);
            $userId = $user->id;
        }

        $employee = Employee::create([
            'user_id' => $userId,
            'name' => $request->name,
            'position' => $request->position,
            'base_salary' => $request->base_salary,
            'allowance' => $request->allowance,
        ]);

        AuditLog::log('Create Employee', 'Created employee profile for ' . $employee->name . ' (' . $employee->position . ')');

        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil didaftarkan.');
    }

    public function logAttendance(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'status' => 'required|array', // employee_id => status
            'status.*' => 'required|in:present,absent,leave',
        ]);

        $date = $request->date;

        foreach ($request->status as $employeeId => $status) {
            Attendance::updateOrCreate(
                ['employee_id' => $employeeId, 'date' => $date],
                ['status' => $status]
            );
        }

        AuditLog::log('Log Attendance', 'Logged attendance for date ' . $date);

        return redirect()->route('employees.index', ['date' => $date])->with([
            'success' => 'Absensi berhasil disimpan.',
            'print_attendance_date' => $date
        ]);
    }

    public function report(Request $request)
    {
        $date = $request->query('date', now()->format('Y-m-d'));

        $employees = Employee::with(['attendances' => function($q) use ($date) {
            $q->whereDate('date', $date);
        }])->orderBy('name')->get();

        return view('attendance_report', compact('employees', 'date'));
    }

    public function updateSalary(Request $request, Employee $employee)
    {
        if (!\Auth::user()->isOwner() && !\Auth::user()->isFinance()) {
            abort(403);
        }

        $request->validate([
            'base_salary' => 'required|numeric|min:0',
            'allowance' => 'required|numeric|min:0',
        ]);

        $employee->update([
            'base_salary' => $request->base_salary,
            'allowance' => $request->allowance,
        ]);

        AuditLog::log('Update Salary', 'Updated salary for employee ' . $employee->name . ' (Base: ' . $request->base_salary . ', Allowance: ' . $request->allowance . ')');

        return back()->with('success', 'Gaji karyawan ' . $employee->name . ' berhasil diperbarui.');
    }

    public function checkIn(Request $request)
    {
        $employee = Employee::where('user_id', \Auth::id())->first();
        if (!$employee) {
            return back()->with('error', 'Profil karyawan Anda belum terdaftar.');
        }

        $request->validate([
            'date' => 'required|date',
            'action' => 'required|in:check_in,check_out,absent_leave',
            'status' => 'nullable|in:present,absent,leave',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'photo' => 'nullable|image|max:3000',
        ]);

        $dateStr = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
        $currentTimeStr = now()->format('H:i');

        // Handle Photo upload
        $imagePath = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            if (!file_exists(public_path('uploads/attendance'))) {
                mkdir(public_path('uploads/attendance'), 0777, true);
            }
            $file->move(public_path('uploads/attendance'), $filename);
            $imagePath = 'uploads/attendance/' . $filename;
        }

        $attendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', $dateStr)
            ->first();

        if ($request->action === 'check_in') {
            // Absen Datang
            if ($attendance) {
                return back()->with('error', 'Anda sudah melakukan absen datang hari ini.');
            }

            if (!$imagePath) {
                return back()->with('error', 'Foto bukti hadir wajib diunggah untuk absen datang.');
            }

            $now = now();
            $standardLateTime = now()->setTime(8, 0, 0);
            $lateMessage = '';
            if ($now->greaterThan($standardLateTime)) {
                $lateMessage = ' (Terlambat)';
            }

            $attendance = Attendance::create([
                'employee_id' => $employee->id,
                'date' => $dateStr,
                'status' => 'present',
                'check_in_time' => $currentTimeStr,
                'check_out_time' => '',
                'overtime_hours' => 0,
                'image_path' => $imagePath,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            AuditLog::log('Employee Check-in', $employee->name . ' checked in for work at ' . $currentTimeStr . $lateMessage);
            return back()->with('success', 'Absen datang berhasil dicatat pukul ' . $currentTimeStr . $lateMessage);

        } elseif ($request->action === 'check_out') {
            // Absen Pulang
            if (!$attendance) {
                return back()->with('error', 'Anda belum melakukan absen datang hari ini.');
            }

            if ($attendance->check_out_time !== '') {
                return back()->with('error', 'Anda sudah melakukan absen pulang hari ini.');
            }

            $now = now();
            $standardExitTime = now()->setTime(17, 0, 0);

            // Calculate Overtime automatically
            $overtimeHours = 0;
            if ($now->greaterThan($standardExitTime)) {
                $overtimeHours = $now->diffInHours($standardExitTime);
            }

            $earlyMessage = '';
            if ($now->lessThan($standardExitTime)) {
                $earlyMessage = ' (Pulang Cepat)';
            }

            $updateData = [
                'check_out_time' => $currentTimeStr,
                'overtime_hours' => $overtimeHours,
            ];

            if ($imagePath) {
                $updateData['image_path'] = $imagePath;
            }
            if ($request->latitude) {
                $updateData['latitude'] = $request->latitude;
                $updateData['longitude'] = $request->longitude;
            }

            $attendance->update($updateData);

            AuditLog::log('Employee Check-out', $employee->name . ' checked out from work at ' . $currentTimeStr . $earlyMessage . ' (Overtime: ' . $overtimeHours . ' hours)');
            return back()->with('success', 'Absen pulang berhasil dicatat pukul ' . $currentTimeStr . $earlyMessage . ($overtimeHours > 0 ? ' (Lembur: ' . $overtimeHours . ' jam)' : ''));

        } elseif ($request->action === 'absent_leave') {
            // Absen Alpa / Izin Cuti
            if ($attendance) {
                return back()->with('error', 'Absensi hari ini sudah terdaftar.');
            }

            $status = $request->status ?? 'leave';
            $attendance = Attendance::create([
                'employee_id' => $employee->id,
                'date' => $dateStr,
                'status' => $status,
                'check_in_time' => '',
                'check_out_time' => '',
                'overtime_hours' => 0,
                'image_path' => null,
                'latitude' => null,
                'longitude' => null,
            ]);

            AuditLog::log('Employee Attendance', $employee->name . ' marked as ' . $status);
            return back()->with('success', 'Absensi (' . strtoupper($status) . ') hari ini berhasil dikirim.');
        }

        return back();
    }

    public function requestAttendance(Request $request)
    {
        $request->validate([
            'month' => 'required|string',
        ]);

        $month = $request->month;

        \App\Models\AttendanceRequest::updateOrCreate(
            ['month' => $month],
            [
                'status' => 'pending',
                'requested_by' => \Auth::id(),
            ]
        );

        AuditLog::log('Request Attendance', 'Finance requested attendance for month ' . $month);

        return back()->with('success', 'Berhasil meminta data absensi ke HRD untuk bulan ' . $month);
    }

    public function provideAttendance(Request $request)
    {
        $request->validate([
            'month' => 'required|string',
        ]);

        $month = $request->month;

        \App\Models\AttendanceRequest::updateOrCreate(
            ['month' => $month],
            [
                'status' => 'provided',
                'provided_by' => \Auth::id(),
            ]
        );

        AuditLog::log('Provide Attendance', 'HRD provided attendance for month ' . $month);

        return back()->with('success', 'Berhasil menyerahkan data absensi untuk bulan ' . $month . ' ke Finance.');
    }

    public function monthlyReport(Request $request)
    {
        $month = $request->query('month', now()->format('Y-m'));

        // Find if this month has been provided
        $attReq = \App\Models\AttendanceRequest::where('month', $month)->first();

        // If logged in user is Finance and it has NOT been provided, and user is not Owner, abort
        if (\Auth::user()->isFinance() && (!$attReq || $attReq->status !== 'provided')) {
            abort(403, 'Akses ditolak. HRD belum menyerahkan/menyetujui absensi untuk bulan ini.');
        }

        $employees = Employee::with(['attendances' => function($q) use ($month) {
            $q->where('date', 'like', $month . '-%');
        }])->orderBy('name')->get();

        return view('attendance_monthly_report', compact('employees', 'month', 'attReq'));
    }

    public function individualReport(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|string',
        ]);

        $employee = Employee::findOrFail($request->employee_id);
        $month = $request->month;

        $attendances = Attendance::where('employee_id', $employee->id)
            ->where('date', 'like', $month . '-%')
            ->orderBy('date')
            ->get();

        return view('attendance_individual_report', compact('employee', 'month', 'attendances'));
    }
}

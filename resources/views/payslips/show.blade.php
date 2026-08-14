<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji - {{ $payslip->employee->name }} - {{ $payslip->month }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background-color: #ffffff;
                color: #000000;
            }
            .print-card {
                border: none !important;
                box-shadow: none !important;
                background: transparent !important;
                padding: 0 !important;
            }
        }
    </style>
</head>
<body class="p-4 md:p-12">

    <!-- Print Button / Back Button -->
    <div class="max-w-2xl mx-auto mb-6 flex justify-between items-center no-print">
        <button onclick="window.close()" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:text-slate-900 transition flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Tutup Halaman</span>
        </button>
        
        <button onclick="window.print()" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-semibold shadow-lg shadow-blue-500/10 transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            <span>Cetak / Cetak PDF</span>
        </button>
    </div>

    <!-- Payslip sheet container -->
    <div class="max-w-2xl mx-auto bg-white border border-slate-200 rounded-3xl p-8 shadow-xl print-card">
        
        <!-- Header -->
        <div class="flex justify-between items-start border-b-2 border-slate-900 pb-6 mb-6">
            <div>
                <h1 class="text-xl font-bold uppercase tracking-wider text-slate-800">SLIP GAJI KARYAWAN</h1>
                <p class="text-xs text-slate-500 mt-1">Sistem Keuangan ERP Internal</p>
            </div>
            <div class="text-right">
                <span class="px-3 py-1 text-xs font-bold uppercase tracking-widest rounded-full bg-slate-100 text-slate-700 border border-slate-300">
                    {{ strtoupper($payslip->status) }}
                </span>
                <p class="text-xs text-slate-500 mt-2">Bulan Gaji: <strong class="text-slate-800">{{ $payslip->month }}</strong></p>
            </div>
        </div>

        <!-- Info details -->
        <div class="grid grid-cols-3 gap-4 text-sm mb-8 bg-slate-50 p-4 rounded-2xl border border-slate-100">
            <div>
                <p class="text-xs text-slate-400 uppercase font-semibold">Nama Karyawan</p>
                <p class="font-bold text-slate-800 mt-0.5">{{ $payslip->employee->name }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase font-semibold">Jabatan / Posisi</p>
                <p class="font-semibold text-slate-700 mt-0.5">{{ $payslip->employee->position }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase font-semibold">Ringkasan Absensi ({{ $payslip->month }})</p>
                @php
                    $hadir = \App\Models\Attendance::where('employee_id', $payslip->employee_id)->where('date', 'like', $payslip->month . '-%')->whereIn('status', ['present', 'leave'])->count();
                    $alpa = \App\Models\Attendance::where('employee_id', $payslip->employee_id)->where('date', 'like', $payslip->month . '-%')->where('status', 'absent')->count();
                    $overtime = \App\Models\Attendance::where('employee_id', $payslip->employee_id)->where('date', 'like', $payslip->month . '-%')->sum('overtime_hours');
                @endphp
                <p class="font-semibold text-slate-700 mt-0.5 text-xs">
                    <span class="text-emerald-600 font-bold">{{ $hadir }} Hadir</span> | 
                    <span class="text-rose-600 font-bold">{{ $alpa }} Alpa</span>
                    @if($overtime > 0)
                        | <span class="text-blue-600 font-bold">{{ $overtime }} Jam Lembur</span>
                    @endif
                </p>
            </div>
        </div>

        <!-- Items Table -->
        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Rincian Penerimaan & Potongan</h3>
        <div class="border border-slate-200 rounded-2xl overflow-hidden mb-8">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 font-semibold">
                        <th class="p-3">Deskripsi</th>
                        <th class="p-3 text-right">Jumlah (Rp)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr>
                        <td class="p-3 text-slate-700">Gaji Pokok</td>
                        <td class="p-3 text-right text-slate-800 font-medium">Rp {{ number_format($payslip->base_salary, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-slate-700">Tunjangan Jabatan</td>
                        <td class="p-3 text-right text-emerald-600 font-medium">+ Rp {{ number_format($payslip->allowance, 0, ',', '.') }}</td>
                    </tr>
                    @if($payslip->overtime_bonus > 0)
                    <tr>
                        <td class="p-3 text-slate-700">Uang Lembur (Overtime)</td>
                        <td class="p-3 text-right text-emerald-600 font-medium">+ Rp {{ number_format($payslip->overtime_bonus, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                    <tr class="bg-rose-50/20">
                        <td class="p-3 text-slate-700">Potongan Ketidakhadiran (Alpa)</td>
                        <td class="p-3 text-right text-rose-600 font-medium">- Rp {{ number_format($payslip->deductions, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Net Salary total -->
        <div class="flex justify-between items-center p-4 bg-slate-900 text-white rounded-2xl mb-8">
            <span class="font-semibold uppercase text-xs tracking-wider text-slate-400">Total Gaji Bersih (Net Take-home Pay)</span>
            <span class="text-xl font-bold">Rp {{ number_format($payslip->net_salary, 0, ',', '.') }}</span>
        </div>

        <!-- Signatures -->
        <div class="grid grid-cols-2 gap-8 text-xs text-center mt-12 pt-8 border-t border-dashed border-slate-200">
            <div>
                <p class="text-slate-400 mb-16">Penerima Karyawan,</p>
                <div class="w-32 mx-auto border-b border-slate-400"></div>
                <p class="font-semibold text-slate-700 mt-2">{{ $payslip->employee->name }}</p>
            </div>
            <div>
                <p class="text-slate-400 mb-16">Dibuat Oleh Finance,</p>
                <div class="w-32 mx-auto border-b border-slate-400"></div>
                <p class="font-semibold text-slate-700 mt-2">Staff Keuangan</p>
            </div>
        </div>

    </div>

</body>
</html>

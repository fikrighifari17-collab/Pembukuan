<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kehadiran Individu - {{ $employee->name }} - {{ \Carbon\Carbon::parse($month.'-01')->format('F Y') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
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

    <!-- Top Action Bar -->
    <div class="max-w-3xl mx-auto mb-6 flex justify-between items-center no-print">
        <button onclick="window.close()" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:text-slate-900 transition flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Tutup Halaman</span>
        </button>
        
        <button onclick="window.print()" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-semibold shadow-lg shadow-blue-500/10 transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            <span>Cetak PDF / Print</span>
        </button>
    </div>

    <!-- Report document -->
    <div class="max-w-3xl mx-auto bg-white border border-slate-200 rounded-3xl p-8 md:p-12 shadow-xl print-card">
        
        <!-- Header / Kop Surat -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b-2 border-slate-800 pb-6 mb-8 gap-4">
            <div>
                <h1 class="text-xl font-bold uppercase tracking-wide text-slate-900">
                    LAPORAN KEHADIRAN INDIVIDU KARYAWAN
                </h1>
                <p class="text-xs text-slate-500 mt-1">ERP Akuntansi & Manajemen SDM</p>
            </div>
            <div class="text-left md:text-right">
                <p class="text-xs text-slate-400">Bulan Laporan</p>
                <p class="text-sm font-semibold text-slate-800">{{ \Carbon\Carbon::parse($month.'-01')->translatedFormat('F Y') }}</p>
            </div>
        </div>

        <!-- Profil Karyawan -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8 bg-slate-50 border border-slate-150 p-4 rounded-2xl text-xs">
            <div>
                <p class="text-slate-400">Nama Karyawan:</p>
                <p class="text-sm font-bold text-slate-800 mt-0.5">{{ $employee->name }}</p>
                <p class="text-slate-400 mt-2">Jabatan:</p>
                <p class="text-sm font-medium text-slate-800 mt-0.5">{{ $employee->position }}</p>
            </div>
            <div class="text-left md:text-right">
                @php
                    $present = $attendances->where('status', 'present')->count();
                    $leave = $attendances->where('status', 'leave')->count();
                    $absent = $attendances->where('status', 'absent')->count();
                    $overtime = $attendances->sum('overtime_hours');
                @endphp
                <p class="text-slate-400">Ringkasan Bulan Ini:</p>
                <div class="mt-2 flex flex-wrap gap-2 justify-start md:justify-end">
                    <span class="px-2 py-1 rounded bg-emerald-100 text-emerald-800 font-semibold">{{ $present }} Hadir</span>
                    <span class="px-2 py-1 rounded bg-amber-100 text-amber-800 font-semibold">{{ $leave }} Izin</span>
                    <span class="px-2 py-1 rounded bg-rose-100 text-rose-800 font-semibold">{{ $absent }} Alpa</span>
                    <span class="px-2 py-1 rounded bg-blue-100 text-blue-800 font-semibold">{{ $overtime }} Jam Lembur</span>
                </div>
            </div>
        </div>

        <!-- Table Grid -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-slate-300 text-slate-500 uppercase tracking-wider font-semibold">
                        <th class="py-3 px-2">Tanggal</th>
                        <th class="py-3 px-2 text-center">Status</th>
                        <th class="py-3 px-2 text-center">Jam Masuk</th>
                        <th class="py-3 px-2 text-center">Jam Keluar</th>
                        <th class="py-3 px-2 text-center">Lembur</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach($attendances as $att)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="py-3 px-2 font-medium text-slate-700">
                                {{ \Carbon\Carbon::parse($att->date)->translatedFormat('d F Y') }}
                            </td>
                            <td class="py-3 px-2 text-center">
                                @if($att->status === 'present')
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">HADIR</span>
                                @elseif($att->status === 'leave')
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">IZIN</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800">ALPA</span>
                                @endif
                            </td>
                            <td class="py-3 px-2 text-center text-slate-600">
                                {{ $att->check_in_time ?: '-' }}
                            </td>
                            <td class="py-3 px-2 text-center text-slate-600">
                                {{ $att->check_out_time ?: '-' }}
                            </td>
                            <td class="py-3 px-2 text-center text-slate-600 font-bold">
                                {{ $att->overtime_hours > 0 ? $att->overtime_hours . ' Jam' : '-' }}
                            </td>
                        </tr>
                    @endforeach
                    @if($attendances->isEmpty())
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">Tidak ada data absensi untuk bulan ini.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-12 pt-6 border-t border-slate-200 flex justify-between items-center text-[10px] text-slate-400">
            <p>Dicetak oleh: {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})</p>
            <p>Sistem Akuntansi & HRD &copy; {{ date('Y') }}</p>
        </div>
    </div>

    <!-- Automatically open print prompt -->
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                window.print();
            }, 800);
        });
    </script>
</body>
</html>

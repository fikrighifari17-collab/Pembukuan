<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kehadiran Karyawan - {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</title>
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
    <div class="max-w-4xl mx-auto mb-6 flex justify-between items-center no-print">
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
    <div class="max-w-4xl mx-auto bg-white border border-slate-200 rounded-3xl p-8 md:p-12 shadow-xl print-card">
        
        <!-- Header / Kop Surat -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b-2 border-slate-800 pb-6 mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold uppercase tracking-wide text-slate-900">
                    LAPORAN KEHADIRAN KARYAWAN
                </h1>
                <p class="text-xs text-slate-500 mt-1">Diekspor secara otomatis setelah pencatatan absensi harian</p>
            </div>
            <div class="text-left md:text-right">
                <p class="text-xs text-slate-400">Tanggal Laporan</p>
                <p class="text-sm font-semibold text-slate-800">{{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}</p>
            </div>
        </div>

        <!-- Attendance Stats Summary -->
        <div class="grid grid-cols-4 gap-4 mb-8">
            <div class="p-4 bg-emerald-50 border border-emerald-100 rounded-2xl">
                <span class="text-[10px] uppercase font-bold text-emerald-600 tracking-wider">Hadir</span>
                <p class="text-2xl font-bold text-emerald-800 mt-1">
                    {{ $employees->filter(fn($e) => $e->attendances->first() && $e->attendances->first()->status === 'present')->count() }} Karyawan
                </p>
            </div>
            <div class="p-4 bg-amber-50 border border-amber-100 rounded-2xl">
                <span class="text-[10px] uppercase font-bold text-amber-600 tracking-wider">Izin/Cuti</span>
                <p class="text-2xl font-bold text-amber-800 mt-1">
                    {{ $employees->filter(fn($e) => $e->attendances->first() && $e->attendances->first()->status === 'leave')->count() }} Karyawan
                </p>
            </div>
            <div class="p-4 bg-rose-50 border border-rose-100 rounded-2xl">
                <span class="text-[10px] uppercase font-bold text-rose-600 tracking-wider">Alpa/Absen</span>
                <p class="text-2xl font-bold text-rose-800 mt-1">
                    {{ $employees->filter(fn($e) => !$e->attendances->first() || $e->attendances->first()->status === 'absent')->count() }} Karyawan
                </p>
            </div>
            <div class="p-4 bg-blue-50 border border-blue-100 rounded-2xl">
                <span class="text-[10px] uppercase font-bold text-blue-600 tracking-wider">Total Staf</span>
                <p class="text-2xl font-bold text-blue-800 mt-1">
                    {{ $employees->count() }} Orang
                </p>
            </div>
        </div>

        <!-- Table Grid -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-slate-300 text-slate-500 uppercase tracking-wider font-semibold">
                        <th class="py-3 px-2">No</th>
                        <th class="py-3 px-2">Nama Karyawan</th>
                        <th class="py-3 px-2">Jabatan</th>
                        <th class="py-3 px-2 text-center">Status</th>
                        <th class="py-3 px-2 text-center">Jam Datang</th>
                        <th class="py-3 px-2 text-center">Jam Pulang</th>
                        <th class="py-3 px-2">Keterangan Lokasi / Bukti</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach($employees as $index => $emp)
                        @php
                            $att = $emp->attendances->first();
                            $status = $att ? $att->status : 'absent';
                        @endphp
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="py-4 px-2 text-slate-400 font-medium">{{ $index + 1 }}</td>
                            <td class="py-4 px-2 font-bold text-slate-800">{{ $emp->name }}</td>
                            <td class="py-4 px-2 text-slate-500">{{ $emp->position }}</td>
                            <td class="py-4 px-2 text-center">
                                @if($status === 'present')
                                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-emerald-100 text-emerald-800 uppercase">Hadir</span>
                                @elseif($status === 'leave')
                                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-amber-100 text-amber-800 uppercase">Izin</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-rose-100 text-rose-800 uppercase">Alpa</span>
                                @endif
                            </td>
                            <td class="py-4 px-2 text-center text-slate-600 font-semibold">
                                {{ ($att && $att->check_in_time) ? $att->check_in_time : '-' }}
                            </td>
                            <td class="py-4 px-2 text-center text-slate-600 font-semibold">
                                {{ ($att && $att->check_out_time) ? $att->check_out_time : '-' }}
                            </td>
                            <td class="py-4 px-2 text-slate-500">
                                @if($status === 'present' && $att)
                                    <div class="space-y-1">
                                        @if($att->latitude && $att->longitude)
                                            <p class="text-[10px]">📍 Jarak Koordinat: {{ $att->latitude }}, {{ $att->longitude }}</p>
                                        @else
                                            <p class="text-[10px] text-slate-400">📍 Koordinat tidak terekam</p>
                                        @endif
                                        @if($att->image_path)
                                            <div class="mt-1">
                                                <a href="{{ asset($att->image_path) }}" target="_blank" class="text-blue-500 hover:underline text-[10px] font-medium flex items-center gap-0.5">
                                                    📸 Lihat Foto Bukti
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Kehadiran Karyawan Bulanan - {{ \Carbon\Carbon::parse($month.'-01')->format('F Y') }}</title>
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
                    REKAPITULASI ABSENSI BULANAN
                </h1>
                <p class="text-xs text-slate-500 mt-1">Laporan Akumulasi Absensi & Kehadiran Karyawan ERP</p>
            </div>
            <div class="text-left md:text-right">
                <p class="text-xs text-slate-400">Bulan Laporan</p>
                <p class="text-sm font-semibold text-slate-800">{{ \Carbon\Carbon::parse($month.'-01')->translatedFormat('F Y') }}</p>
            </div>
        </div>

        <div class="mb-6 p-4 rounded-xl bg-slate-50 border border-slate-150 text-xs flex justify-between items-center">
            <div>
                <p class="font-semibold text-slate-700">Status Penyerahan Dokumen:</p>
                @if($attReq && $attReq->status === 'provided')
                    <span class="inline-flex mt-1 items-center px-2 py-0.5 rounded-full font-bold bg-emerald-100 text-emerald-800 uppercase text-[9px]">Diserahkan oleh HRD</span>
                @else
                    <span class="inline-flex mt-1 items-center px-2 py-0.5 rounded-full font-bold bg-amber-100 text-amber-800 uppercase text-[9px]">Belum Diserahkan</span>
                @endif
            </div>
            @if($attReq)
                <div class="text-right text-slate-500">
                    @if($attReq->requester)
                        <p>Diminta oleh: <strong>{{ $attReq->requester->name }}</strong></p>
                    @endif
                    @if($attReq->provider)
                        <p>Diserahkan oleh: <strong>{{ $attReq->provider->name }}</strong> pada {{ $attReq->updated_at->format('d/m/Y H:i') }}</p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Table Grid -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-slate-300 text-slate-500 uppercase tracking-wider font-semibold">
                        <th class="py-3 px-2">No</th>
                        <th class="py-3 px-2">Nama Karyawan</th>
                        <th class="py-3 px-2">Jabatan</th>
                        <th class="py-3 px-2 text-center text-emerald-600">Hadir</th>
                        <th class="py-3 px-2 text-center text-amber-600">Izin/Cuti</th>
                        <th class="py-3 px-2 text-center text-rose-600">Alpa</th>
                        <th class="py-3 px-2 text-center text-blue-600">Total Jam Lembur</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach($employees as $index => $emp)
                        @php
                            $presentCount = $emp->attendances->where('status', 'present')->count();
                            $leaveCount = $emp->attendances->where('status', 'leave')->count();
                            $absentCount = $emp->attendances->where('status', 'absent')->count();
                            $overtimeSum = $emp->attendances->sum('overtime_hours');
                        @endphp
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="py-4 px-2 text-slate-400 font-medium">{{ $index + 1 }}</td>
                            <td class="py-4 px-2 font-bold text-slate-800">{{ $emp->name }}</td>
                            <td class="py-4 px-2 text-slate-500">{{ $emp->position }}</td>
                            <td class="py-4 px-2 text-center text-slate-700 font-bold bg-emerald-50/20">
                                {{ $presentCount }} Hari
                            </td>
                            <td class="py-4 px-2 text-center text-slate-700 font-bold bg-amber-50/20">
                                {{ $leaveCount }} Hari
                            </td>
                            <td class="py-4 px-2 text-center text-slate-700 font-bold bg-rose-50/20">
                                {{ $absentCount }} Hari
                            </td>
                            <td class="py-4 px-2 text-center text-slate-700 font-bold bg-blue-50/20">
                                {{ $overtimeSum }} Jam
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

@extends('layouts.app')

@section('page_title', 'Dashboard Ringkasan Keuangan & HR')

@section('content')

    <!-- Header Actions -->
    @if(Auth::user()->isOwner() || Auth::user()->isFinance())
    <div class="flex justify-between items-center mb-6">
        <p class="text-sm text-slate-400">Ringkasan real-time keuangan dan operasional perusahaan Anda.</p>
        <a href="{{ route('dashboard.export') }}" target="_blank" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-xs font-semibold shadow-lg shadow-blue-500/10 transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            <span>Cetak Laporan Kas (PDF)</span>
        </a>
    </div>
    @else
    <div class="mb-6">
        <p class="text-sm text-slate-400">Selamat datang kembali, <strong class="text-slate-200 font-semibold">{{ Auth::user()->name }}</strong>! Berikut ringkasan kontrak kerja dan slip gaji Anda.</p>
    </div>
    @endif

    @if(Auth::user()->isOwner() || Auth::user()->isFinance())
    <!-- Top Cards Summary -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mb-8">
        
        <!-- Total Uang Perusahaan -->
        @if(Auth::user()->isOwner() || Auth::user()->isFinance())
            <a href="{{ route('dashboard.export', ['type' => 'company_funds']) }}" target="_blank" title="Klik untuk mencetak Laporan Uang Perusahaan" class="glass-panel p-6 rounded-2xl border-l-4 border-violet-500 relative overflow-hidden group hover:scale-[1.02] transition duration-300 block">
        @else
            <div class="glass-panel p-6 rounded-2xl border-l-4 border-violet-500 relative overflow-hidden group hover:scale-[1.02] transition duration-300">
        @endif
            <div class="absolute -right-4 -bottom-4 text-violet-500/10 group-hover:scale-110 transition duration-300">
                <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <p class="text-xs font-semibold uppercase text-slate-400 tracking-wider">Uang Perusahaan</p>
            <h3 class="text-2xl font-bold mt-2 text-violet-400">Rp {{ number_format($companyFunds, 0, ',', '.') }}</h3>
            <p class="text-xs text-slate-400 mt-2">Saldo Dasar 10M + Laba/Rugi</p>
        @if(Auth::user()->isOwner() || Auth::user()->isFinance())
            </a>
        @else
            </div>
        @endif
        
        <!-- Total Pemasukan -->
        @if(Auth::user()->isOwner() || Auth::user()->isFinance())
            <a href="{{ route('dashboard.export', ['type' => 'income']) }}" target="_blank" title="Klik untuk mencetak Laporan Pemasukan" class="glass-panel p-6 rounded-2xl border-l-4 border-emerald-500 relative overflow-hidden group hover:scale-[1.02] transition duration-300 block">
        @else
            <div class="glass-panel p-6 rounded-2xl border-l-4 border-emerald-500 relative overflow-hidden group hover:scale-[1.02] transition duration-300">
        @endif
            <div class="absolute -right-4 -bottom-4 text-emerald-500/10 group-hover:scale-110 transition duration-300">
                <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            </div>
            <p class="text-xs font-semibold uppercase text-slate-400 tracking-wider">Total Pemasukan</p>
            <h3 class="text-2xl font-bold mt-2 text-emerald-400">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
            <p class="text-xs text-slate-400 mt-2">Akumulasi seluruh transaksi masuk</p>
        @if(Auth::user()->isOwner() || Auth::user()->isFinance())
            </a>
        @else
            </div>
        @endif

        <!-- Total Pengeluaran -->
        @if(Auth::user()->isOwner() || Auth::user()->isFinance())
            <a href="{{ route('dashboard.export', ['type' => 'expense']) }}" target="_blank" title="Klik untuk mencetak Laporan Pengeluaran" class="glass-panel p-6 rounded-2xl border-l-4 border-rose-500 relative overflow-hidden group hover:scale-[1.02] transition duration-300 block">
        @else
            <div class="glass-panel p-6 rounded-2xl border-l-4 border-rose-500 relative overflow-hidden group hover:scale-[1.02] transition duration-300">
        @endif
            <div class="absolute -right-4 -bottom-4 text-rose-500/10 group-hover:scale-110 transition duration-300">
                <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path></svg>
            </div>
            <p class="text-xs font-semibold uppercase text-slate-400 tracking-wider">Total Pengeluaran</p>
            <h3 class="text-2xl font-bold mt-2 text-rose-400">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h3>
            <p class="text-xs text-slate-400 mt-2">Termasuk gaji & belanja barang</p>
        @if(Auth::user()->isOwner() || Auth::user()->isFinance())
            </a>
        @else
            </div>
        @endif

        <!-- Saldo / Kas Bersih -->
        @if(Auth::user()->isOwner() || Auth::user()->isFinance())
            <a href="{{ route('dashboard.export', ['type' => 'balance']) }}" target="_blank" title="Klik untuk mencetak Laporan Saldo Kas" class="glass-panel p-6 rounded-2xl border-l-4 border-blue-500 relative overflow-hidden group hover:scale-[1.02] transition duration-300 block">
        @else
            <div class="glass-panel p-6 rounded-2xl border-l-4 border-blue-500 relative overflow-hidden group hover:scale-[1.02] transition duration-300">
        @endif
            <div class="absolute -right-4 -bottom-4 text-blue-500/10 group-hover:scale-110 transition duration-300">
                <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
            </div>
            <p class="text-xs font-semibold uppercase text-slate-400 tracking-wider">Saldo Bersih (Kas)</p>
            <h3 class="text-2xl font-bold mt-2 {{ $balance >= 0 ? 'text-blue-400' : 'text-rose-400' }}">Rp {{ number_format($balance, 0, ',', '.') }}</h3>
            <p class="text-xs text-slate-400 mt-2">Selisih laba/rugi saat ini</p>
        @if(Auth::user()->isOwner() || Auth::user()->isFinance())
            </a>
        @else
            </div>
        @endif

        <!-- Request Pembelian Pending -->
        <div class="glass-panel p-6 rounded-2xl border-l-4 border-amber-500 relative overflow-hidden group hover:scale-[1.02] transition duration-300">
            <div class="absolute -right-4 -bottom-4 text-amber-500/10 group-hover:scale-110 transition duration-300">
                <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <p class="text-xs font-semibold uppercase text-slate-400 tracking-wider">Persetujuan Pending</p>
            <h3 class="text-2xl font-bold mt-2 text-amber-400">{{ $pendingRequestsCount }} Request</h3>
            <p class="text-xs text-slate-400 mt-2">Memerlukan verifikasi admin</p>
        </div>

    </div>

    <!-- Chart / Visual comparison section -->
    <div class="glass-panel rounded-2xl p-6 mb-8">
        <h3 class="text-sm font-semibold uppercase text-slate-400 mb-4 tracking-wider">Visualisasi Perbandingan Kas</h3>
        <div class="space-y-4">
            @php
                $totalSum = $totalIncome + $totalExpense;
                $incomePercent = $totalSum > 0 ? ($totalIncome / $totalSum) * 100 : 50;
                $expensePercent = $totalSum > 0 ? ($totalExpense / $totalSum) * 100 : 50;
            @endphp
            <div class="flex justify-between items-center text-sm">
                <span class="text-emerald-400 flex items-center gap-1.5"><span class="w-3 h-3 rounded-full bg-emerald-500"></span> Pemasukan ({{ number_format($incomePercent, 1) }}%)</span>
                <span class="text-rose-400 flex items-center gap-1.5"><span class="w-3 h-3 rounded-full bg-rose-500"></span> Pengeluaran ({{ number_format($expensePercent, 1) }}%)</span>
            </div>
            <div class="w-full h-4 bg-slate-900 rounded-full overflow-hidden flex">
                <div class="h-full bg-gradient-to-r from-emerald-500 to-emerald-400 transition-all duration-500" style="width: {{ $incomePercent }}%"></div>
                <div class="h-full bg-gradient-to-r from-rose-500 to-rose-400 transition-all duration-500" style="width: {{ $expensePercent }}%"></div>
            </div>
        </div>
    </div>
    @endif

    <!-- Split view depending on Roles -->
    @if(Auth::user()->isHrd())
        <!-- HRD Dashboard View -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left 2 columns -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Rangkuman Karyawan & Absensi Hari Ini -->
                <div class="glass-panel p-6 rounded-2xl">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-slate-800 pb-4 mb-4 gap-4">
                        <h3 class="font-bold text-lg text-slate-200">
                            Absensi Tanggal: <span class="text-blue-400 font-extrabold">{{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d F Y') }}</span>
                        </h3>
                        
                        <!-- Date Filter Form -->
                        <form action="{{ route('dashboard') }}" method="GET" class="flex items-center gap-2">
                            <label class="text-xs text-slate-400">Pilih Tanggal:</label>
                            <input type="date" name="date" value="{{ $selectedDate }}" onchange="this.form.submit()" class="px-3 py-1.5 rounded-xl bg-slate-900 border border-slate-800 text-xs text-white focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </form>
                    </div>
                    @php
                        $todayDate = $selectedDate;
                        $employeesList = \App\Models\Employee::with(['attendances' => function($q) use ($todayDate) {
                            $q->whereDate('date', $todayDate);
                        }])->get();
                        
                        $presentCount = $employeesList->filter(fn($e) => $e->attendances->first() && $e->attendances->first()->status === 'present')->count();
                        $leaveCount = $employeesList->filter(fn($e) => $e->attendances->first() && $e->attendances->first()->status === 'leave')->count();
                        $absentCount = $employeesList->filter(fn($e) => !$e->attendances->first() || $e->attendances->first()->status === 'absent')->count();
                    @endphp

                    <!-- Print Actions Section -->
                    <div class="flex flex-wrap items-center gap-4 bg-slate-900/40 p-4 rounded-xl border border-slate-800 mb-6 text-xs">
                        <div class="flex items-center gap-2">
                            <span class="text-slate-400 font-semibold uppercase tracking-wider text-[10px]">Cetak PDF Laporan:</span>
                        </div>
                        
                        <!-- 1. Per Hari -->
                        <a href="{{ route('attendance.report', ['date' => $selectedDate]) }}" target="_blank" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-500 text-white rounded-lg font-semibold transition flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            <span>Per Hari Ini</span>
                        </a>

                        <!-- 2. Bulanan (1 Bulan) -->
                        <a href="{{ route('attendance.monthly_report', ['month' => date('Y-m', strtotime($selectedDate))]) }}" target="_blank" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg font-semibold transition flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4v-4m-9 18h10a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>1 Bulan Terpilih</span>
                        </a>

                        <!-- 3. Per Orang -->
                        <form action="{{ route('attendance.individual_report') }}" method="GET" target="_blank" class="flex items-center gap-2">
                            <input type="hidden" name="month" value="{{ date('Y-m', strtotime($selectedDate)) }}">
                            <select name="employee_id" required class="px-2 py-1.5 rounded-lg bg-slate-950 border border-slate-800 text-white text-xs focus:outline-none">
                                <option value="" disabled selected>Pilih Karyawan...</option>
                                @foreach($employeesList as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="px-3 py-1.5 bg-amber-600 hover:bg-amber-500 text-white rounded-lg font-semibold transition flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                <span>Per Orang</span>
                            </button>
                        </form>
                    </div>

                    <div class="grid grid-cols-3 gap-4 text-center mb-6">
                        <div class="p-4 bg-emerald-950/40 border border-emerald-800/40 rounded-xl">
                            <span class="text-xs text-slate-400 font-medium">Hadir</span>
                            <h4 class="text-xl font-bold text-emerald-400 mt-1">{{ $presentCount }} Staf</h4>
                        </div>
                        <div class="p-4 bg-amber-950/40 border border-amber-800/40 rounded-xl">
                            <span class="text-xs text-slate-400 font-medium">Izin</span>
                            <h4 class="text-xl font-bold text-amber-400 mt-1">{{ $leaveCount }} Staf</h4>
                        </div>
                        <div class="p-4 bg-rose-950/40 border border-rose-800/40 rounded-xl">
                            <span class="text-xs text-slate-400 font-medium">Alpa</span>
                            <h4 class="text-xl font-bold text-rose-400 mt-1">{{ $absentCount }} Staf</h4>
                        </div>
                    </div>

                    <!-- Today's Attendance List -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="text-slate-400 border-b border-slate-800">
                                    <th class="pb-2">Nama Karyawan</th>
                                    <th class="pb-2">Jabatan</th>
                                    <th class="pb-2 text-center">Status</th>
                                    <th class="pb-2 text-center">Jam Datang</th>
                                    <th class="pb-2 text-center">Jam Pulang</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-800/40">
                                @foreach($employeesList as $emp)
                                    @php
                                        $att = $emp->attendances->first();
                                    @endphp
                                    <tr class="hover:bg-slate-900/10 transition">
                                        <td class="py-3 font-semibold text-slate-200">{{ $emp->name }}</td>
                                        <td class="py-3 text-slate-400 text-xs">{{ $emp->position }}</td>
                                        <td class="py-3 text-center">
                                            @if($att && $att->status === 'present')
                                                <span class="text-[10px] px-2 py-0.5 rounded-full bg-emerald-950 text-emerald-400 border border-emerald-800 font-bold uppercase">Hadir</span>
                                            @elseif($att && $att->status === 'leave')
                                                <span class="text-[10px] px-2 py-0.5 rounded-full bg-amber-950 text-amber-400 border border-amber-800 font-bold uppercase">Izin</span>
                                            @else
                                                <span class="text-[10px] px-2 py-0.5 rounded-full bg-rose-950 text-rose-400 border border-rose-800 font-bold uppercase">Alpa</span>
                                            @endif
                                        </td>
                                        <td class="py-3 text-center font-medium text-slate-300">
                                            {{ ($att && $att->check_in_time) ? $att->check_in_time : '-' }}
                                        </td>
                                        <td class="py-3 text-center font-medium text-slate-300">
                                            {{ ($att && $att->check_out_time) ? $att->check_out_time : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- Right 1 column -->
            <div class="space-y-8">
                <!-- Serah Terima Absensi Bulanan Widget -->
                <div class="glass-panel p-6 rounded-2xl">
                    <h3 class="font-bold text-lg text-slate-200 border-b border-slate-800 pb-4 mb-4">Serah Terima Absensi</h3>
                    @php
                        $monthNow = now()->format('Y-m');
                        $monthPrev = now()->subMonth()->format('Y-m');
                        
                        $reqNow = \App\Models\AttendanceRequest::where('month', $monthNow)->first();
                        $reqPrev = \App\Models\AttendanceRequest::where('month', $monthPrev)->first();
                    @endphp
                    
                    <div class="space-y-4">
                        <!-- Current Month -->
                        <div class="p-4 rounded-xl bg-slate-900/40 border border-slate-800 space-y-3">
                            <div class="flex justify-between items-center">
                                <h4 class="font-bold text-xs uppercase text-slate-400">
                                    {{ \Carbon\Carbon::parse($monthNow.'-01')->translatedFormat('F Y') }}
                                </h4>
                                @if($reqNow && $reqNow->status === 'provided')
                                    <span class="text-[9px] px-2 py-0.5 rounded bg-emerald-950 text-emerald-400 border border-emerald-800 font-bold uppercase">Diserahkan</span>
                                @elseif($reqNow && $reqNow->status === 'pending')
                                    <span class="text-[9px] px-2 py-0.5 rounded bg-amber-950 text-amber-400 border border-amber-800 font-bold uppercase">Diminta Finance</span>
                                @else
                                    <span class="text-[9px] px-2 py-0.5 rounded bg-slate-800 text-slate-500 border border-slate-700 font-bold uppercase">Belum Dikirim</span>
                                @endif
                            </div>

                            @if($reqNow)
                                <div class="p-2.5 rounded bg-slate-950/40 border border-slate-850 text-[10px] text-slate-400 space-y-1">
                                    @if($reqNow->requested_by && $reqNow->created_at)
                                        <p>Diminta oleh: <span class="text-slate-300 font-semibold">{{ $reqNow->requester->name }}</span></p>
                                        <p>Waktu Minta: <span class="text-slate-300">{{ $reqNow->created_at->translatedFormat('d F Y, H:i') }}</span></p>
                                    @endif
                                    @if($reqNow->provided_by && $reqNow->updated_at && $reqNow->status === 'provided')
                                        <p>Diserahkan oleh: <span class="text-slate-300 font-semibold">{{ $reqNow->provider->name }}</span></p>
                                        <p>Waktu Serah: <span class="text-slate-300">{{ $reqNow->updated_at->translatedFormat('d F Y, H:i') }}</span></p>
                                    @endif
                                </div>
                            @endif
                            
                            @if(!$reqNow || $reqNow->status !== 'provided')
                                <form action="{{ route('attendance.provide') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="month" value="{{ $monthNow }}">
                                    <button type="submit" class="w-full py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-semibold transition">
                                        Serahkan Absensi
                                    </button>
                                </form>
                            @else
                                <p class="text-[10px] text-slate-400 text-center">Absensi bulan ini sudah diserahkan ke Finance.</p>
                            @endif
                        </div>

                        <!-- Previous Month -->
                        <div class="p-4 rounded-xl bg-slate-900/40 border border-slate-800 space-y-3">
                            <div class="flex justify-between items-center">
                                <h4 class="font-bold text-xs uppercase text-slate-400">
                                    {{ \Carbon\Carbon::parse($monthPrev.'-01')->translatedFormat('F Y') }}
                                </h4>
                                @if($reqPrev && $reqPrev->status === 'provided')
                                    <span class="text-[9px] px-2 py-0.5 rounded bg-emerald-950 text-emerald-400 border border-emerald-800 font-bold uppercase">Diserahkan</span>
                                @elseif($reqPrev && $reqPrev->status === 'pending')
                                    <span class="text-[9px] px-2 py-0.5 rounded bg-amber-950 text-amber-400 border border-amber-800 font-bold uppercase">Diminta Finance</span>
                                @else
                                    <span class="text-[9px] px-2 py-0.5 rounded bg-slate-800 text-slate-500 border border-slate-700 font-bold uppercase">Belum Dikirim</span>
                                @endif
                            </div>

                            @if($reqPrev)
                                <div class="p-2.5 rounded bg-slate-950/40 border border-slate-850 text-[10px] text-slate-400 space-y-1">
                                    @if($reqPrev->requested_by && $reqPrev->created_at)
                                        <p>Diminta oleh: <span class="text-slate-300 font-semibold">{{ $reqPrev->requester->name }}</span></p>
                                        <p>Waktu Minta: <span class="text-slate-300">{{ $reqPrev->created_at->translatedFormat('d F Y, H:i') }}</span></p>
                                    @endif
                                    @if($reqPrev->provided_by && $reqPrev->updated_at && $reqPrev->status === 'provided')
                                        <p>Diserahkan oleh: <span class="text-slate-300 font-semibold">{{ $reqPrev->provider->name }}</span></p>
                                        <p>Waktu Serah: <span class="text-slate-300">{{ $reqPrev->updated_at->translatedFormat('d F Y, H:i') }}</span></p>
                                    @endif
                                </div>
                            @endif
                            
                            @if(!$reqPrev || $reqPrev->status !== 'provided')
                                <form action="{{ route('attendance.provide') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="month" value="{{ $monthPrev }}">
                                    <button type="submit" class="w-full py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-semibold transition">
                                        Serahkan Absensi
                                    </button>
                                </form>
                            @else
                                <p class="text-[10px] text-slate-400 text-center">Absensi bulan lalu sudah diserahkan ke Finance.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif(Auth::user()->isKaryawan())
        <!-- Karyawan Portal View -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Absensi Hari Ini -->
            <div class="glass-panel rounded-2xl p-6">
                <h3 class="font-bold text-lg text-slate-200 border-b border-slate-800 pb-4 mb-4">Absensi & Lembur Hari Ini</h3>
                @php
                    $todayDate = date('Y-m-d');
                    $myTodayAttendance = null;
                    if ($myEmployeeInfo) {
                        $myTodayAttendance = \App\Models\Attendance::where('employee_id', $myEmployeeInfo->id)->whereDate('date', $todayDate)->first();
                    }
                @endphp
                @if($myEmployeeInfo)
                    @php
                        $nowHour = (int)date('H');
                        $nowMinute = (int)date('i');
                        $isAfter7AM = ($nowHour > 7 || ($nowHour === 7 && $nowMinute >= 0));
                        $isAfter5PM = ($nowHour > 17 || ($nowHour === 17 && $nowMinute >= 0));
                    @endphp

                    @if(!$myTodayAttendance)
                        <!-- Tab or toggle to select: Hadir (Check-in) vs Izin/Alpa -->
                        <div class="mb-4 flex border-b border-slate-800 pb-2">
                            <button id="tab_check_in" onclick="switchAttTab('check_in')" class="flex-1 text-center py-2 text-xs font-semibold border-b-2 border-blue-500 text-blue-400">Absen Datang (Hadir)</button>
                            <button id="tab_absent_leave" onclick="switchAttTab('absent_leave')" class="flex-1 text-center py-2 text-xs font-semibold border-b-2 border-transparent text-slate-400 hover:text-slate-200">Izin / Alpa / Cuti</button>
                        </div>

                        <!-- Check-In Form (Hadir) -->
                        <form id="form_check_in" action="{{ route('attendance.check_in') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <input type="hidden" name="date" value="{{ $todayDate }}">
                            <input type="hidden" name="action" value="check_in">
                            <input type="hidden" name="latitude" id="lat_checkin" value="">
                            <input type="hidden" name="longitude" id="lng_checkin" value="">

                            <div>
                                <p class="text-xs text-slate-400 mb-1">Tanggal: <strong class="text-slate-300">{{ date('d F Y') }}</strong></p>
                                <p class="text-xs text-blue-400 font-semibold flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span> Jam Realtime: {{ date('H:i') }}</p>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 font-medium">Foto Bukti Datang</label>
                                <input type="file" name="photo" accept="image/*" required onchange="previewImage(this, 'preview_checkin')" class="w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-800 file:text-slate-300 hover:file:bg-slate-700">
                                <div class="mt-2 hidden" id="wrapper_preview_checkin">
                                    <img id="preview_checkin" class="max-h-40 rounded-lg border border-slate-750 mx-auto">
                                </div>
                            </div>

                            <div class="pt-2">
                                <div class="flex justify-between items-center mb-2">
                                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Lokasi GPS</label>
                                    <button type="button" onclick="requestLocationCheckin()" class="text-[10px] text-blue-400 hover:underline flex items-center gap-1">🔄 Segarkan Lokasi</button>
                                </div>
                                <div id="gps_status_checkin" class="text-xs p-3 rounded-xl bg-slate-900 border border-slate-800/80 text-slate-300 flex items-center gap-2">
                                    <span class="animate-pulse w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                                    <span>Mendeteksi koordinat...</span>
                                </div>
                            </div>

                            <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-xs font-semibold transition mt-2">
                                Absen Datang (Masuk Kerja)
                            </button>
                        </form>

                        <!-- Absent/Leave Form -->
                        <form id="form_absent_leave" action="{{ route('attendance.check_in') }}" method="POST" class="space-y-4 hidden">
                            @csrf
                            <input type="hidden" name="date" value="{{ $todayDate }}">
                            <input type="hidden" name="action" value="absent_leave">

                            <div>
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Pilih Keterangan</label>
                                <select name="status" required class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none text-xs">
                                    <option value="leave">Izin / Cuti</option>
                                    <option value="absent">Tidak Hadir (Alpa)</option>
                                </select>
                            </div>

                            <button type="submit" class="w-full py-2.5 bg-slate-700 hover:bg-slate-600 text-white rounded-xl text-xs font-semibold transition mt-2">
                                Kirim Keterangan
                            </button>
                        </form>

                    @elseif($myTodayAttendance->status === 'present' && $myTodayAttendance->check_out_time === '')
                        <!-- Check-Out Form (Absen Pulang) -->
                        <form action="{{ route('attendance.check_in') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <input type="hidden" name="date" value="{{ $todayDate }}">
                            <input type="hidden" name="action" value="check_out">
                            <input type="hidden" name="latitude" id="lat_checkout" value="">
                            <input type="hidden" name="longitude" id="lng_checkout" value="">

                            <div>
                                <p class="text-xs text-slate-400 mb-1">Tanggal Hari Ini: <strong class="text-slate-300">{{ date('d F Y') }}</strong></p>
                                <div class="text-xs text-slate-300 bg-slate-900/40 p-3 rounded-xl border border-slate-800 space-y-1">
                                    <p>Absen Datang: <strong class="text-emerald-400 font-semibold">{{ $myTodayAttendance->check_in_time }}</strong></p>
                                    <p class="text-blue-400 font-semibold flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span> Jam Realtime: {{ date('H:i') }}</p>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 font-medium">Foto Bukti Pulang (Opsional)</label>
                                <input type="file" name="photo" accept="image/*" onchange="previewImage(this, 'preview_checkout')" class="w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-800 file:text-slate-300 hover:file:bg-slate-700">
                                <div class="mt-2 hidden" id="wrapper_preview_checkout">
                                    <img id="preview_checkout" class="max-h-40 rounded-lg border border-slate-750 mx-auto">
                                </div>
                            </div>

                            <div class="pt-2">
                                <div class="flex justify-between items-center mb-2">
                                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Lokasi GPS</label>
                                    <button type="button" onclick="requestLocationCheckout()" class="text-[10px] text-blue-400 hover:underline flex items-center gap-1">🔄 Segarkan Lokasi</button>
                                </div>
                                <div id="gps_status_checkout" class="text-xs p-3 rounded-xl bg-slate-900 border border-slate-800/80 text-slate-300 flex items-center gap-2">
                                    <span class="animate-pulse w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                                    <span>Mendeteksi koordinat...</span>
                                </div>
                            </div>

                            <button type="submit" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-semibold transition mt-2">
                                Absen Pulang (Selesai Kerja)
                            </button>
                        </form>

                    @else
                        <!-- Already completed / Izin / Cuti -->
                        <div class="space-y-4">
                            <p class="text-xs text-slate-400">Tanggal: <strong class="text-slate-300">{{ date('d F Y') }}</strong></p>
                            <div class="space-y-2 text-xs text-slate-300 bg-slate-900/40 p-4 rounded-xl border border-slate-800">
                                <p class="flex justify-between">
                                    <span>Status Kehadiran:</span>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $myTodayAttendance->status === 'present' ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : ($myTodayAttendance->status === 'absent' ? 'bg-rose-950 text-rose-400 border border-rose-800' : 'bg-blue-950 text-blue-400 border border-blue-800') }}">
                                        {{ $myTodayAttendance->status === 'present' ? 'HADIR' : ($myTodayAttendance->status === 'absent' ? 'ALPA' : 'IZIN') }}
                                    </span>
                                </p>
                                @if($myTodayAttendance->status === 'present')
                                    <p class="flex justify-between">
                                        <span>Jam Masuk:</span>
                                        <span class="font-semibold text-slate-200">{{ $myTodayAttendance->check_in_time }}</span>
                                    </p>
                                    <p class="flex justify-between">
                                        <span>Jam Pulang:</span>
                                        <span class="font-semibold text-slate-200">{{ $myTodayAttendance->check_out_time }}</span>
                                    </p>
                                    @if($myTodayAttendance->overtime_hours > 0)
                                        <p class="flex justify-between text-emerald-400 font-semibold">
                                            <span>Lembur Terhitung:</span>
                                            <span>{{ $myTodayAttendance->overtime_hours }} jam (+Rp {{ number_format($myTodayAttendance->overtime_hours * 50000, 0, ',', '.') }})</span>
                                        </p>
                                    @endif
                                @endif
                            </div>
                            <div class="bg-emerald-950/20 border border-emerald-800/40 p-3 rounded-xl">
                                <p class="text-emerald-400 text-xs text-center font-medium">Absensi Anda hari ini telah selesai dicatat. Terima kasih!</p>
                            </div>
                        </div>
                    @endif

                    <script>
                        function switchAttTab(tab) {
                            const btnCheckin = document.getElementById('tab_check_in');
                            const btnLeave = document.getElementById('tab_absent_leave');
                            const formCheckin = document.getElementById('form_check_in');
                            const formLeave = document.getElementById('form_absent_leave');

                            if (tab === 'check_in') {
                                btnCheckin.className = "flex-1 text-center py-2 text-xs font-semibold border-b-2 border-blue-500 text-blue-400";
                                btnLeave.className = "flex-1 text-center py-2 text-xs font-semibold border-b-2 border-transparent text-slate-400 hover:text-slate-200";
                                formCheckin.classList.remove('hidden');
                                formLeave.classList.add('hidden');
                                requestLocationCheckin();
                            } else {
                                btnCheckin.className = "flex-1 text-center py-2 text-xs font-semibold border-b-2 border-transparent text-slate-400 hover:text-slate-200";
                                btnLeave.className = "flex-1 text-center py-2 text-xs font-semibold border-b-2 border-blue-500 text-blue-400";
                                formCheckin.classList.add('hidden');
                                formLeave.classList.remove('hidden');
                            }
                        }

                        function requestLocationCheckin() {
                            const statusText = document.getElementById('gps_status_checkin');
                            const latInput = document.getElementById('lat_checkin');
                            const lngInput = document.getElementById('lng_checkin');
                            if (!statusText) return;
                            
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(
                                    function(position) {
                                        const lat = position.coords.latitude;
                                        const lng = position.coords.longitude;
                                        latInput.value = lat;
                                        lngInput.value = lng;
                                        statusText.innerHTML = `📍 Terdeteksi: ${lat.toFixed(6)}, ${lng.toFixed(6)} <span class="text-emerald-400 font-bold ml-1">(Lokasi Terverifikasi)</span>`;
                                    },
                                    function(error) {
                                        statusText.innerHTML = `⚠️ <span class="text-rose-400">Gagal melacak GPS. Aktifkan lokasi.</span>`;
                                    },
                                    { enableHighAccuracy: true, timeout: 10000 }
                                );
                            }
                        }

                        function requestLocationCheckout() {
                            const statusText = document.getElementById('gps_status_checkout');
                            const latInput = document.getElementById('lat_checkout');
                            const lngInput = document.getElementById('lng_checkout');
                            if (!statusText) return;

                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(
                                    function(position) {
                                        const lat = position.coords.latitude;
                                        const lng = position.coords.longitude;
                                        latInput.value = lat;
                                        lngInput.value = lng;
                                        statusText.innerHTML = `📍 Terdeteksi: ${lat.toFixed(6)}, ${lng.toFixed(6)} <span class="text-emerald-400 font-bold ml-1">(Lokasi Terverifikasi)</span>`;
                                    },
                                    function(error) {
                                        statusText.innerHTML = `⚠️ <span class="text-rose-400">Gagal melacak GPS. Aktifkan lokasi.</span>`;
                                    },
                                    { enableHighAccuracy: true, timeout: 10000 }
                                );
                            }
                        }

                        function previewImage(input, previewId) {
                            const preview = document.getElementById(previewId);
                            const wrapper = document.getElementById('wrapper_' + previewId);
                            if (input.files && input.files[0]) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    preview.src = e.target.result;
                                    wrapper.classList.remove('hidden');
                                }
                                reader.readAsDataURL(input.files[0]);
                            } else {
                                preview.src = '';
                                wrapper.classList.add('hidden');
                            }
                        }

                        setTimeout(() => {
                            requestLocationCheckin();
                            requestLocationCheckout();
                        }, 500);
                    </script>
                @else
                    <p class="text-slate-400 text-sm">Profil Karyawan Anda belum didaftarkan oleh Owner.</p>
                @endif
            </div>

            <!-- Profil Gaji -->
            <div class="glass-panel rounded-2xl p-6">
                <div class="border-b border-slate-800 pb-4 mb-4 flex justify-between items-center">
                    <h3 class="font-bold text-lg text-slate-200">Informasi Kontrak & Gaji</h3>
                    <span class="text-xs bg-blue-900/60 text-blue-300 px-3 py-1 rounded-full uppercase font-bold">{{ $myEmployeeInfo->position ?? 'Karyawan' }}</span>
                </div>
                @if($myEmployeeInfo)
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-slate-800/40">
                            <span class="text-slate-400">Gaji Pokok:</span>
                            <span class="font-semibold text-slate-200">Rp {{ number_format($myEmployeeInfo->base_salary, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-slate-800/40">
                            <span class="text-slate-400">Tunjangan Jabatan:</span>
                            <span class="font-semibold text-slate-200">Rp {{ number_format($myEmployeeInfo->allowance, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-slate-400">Total Potensi Bersih:</span>
                            <span class="font-bold text-blue-400">Rp {{ number_format($myEmployeeInfo->base_salary + $myEmployeeInfo->allowance, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @else
                    <p class="text-slate-400 text-sm">Profil Karyawan Anda belum didaftarkan oleh Owner.</p>
                @endif
            </div>

            <!-- Slip Gaji Terakhir -->
            <div class="glass-panel rounded-2xl p-6">
                <h3 class="font-bold text-lg text-slate-200 border-b border-slate-800 pb-4 mb-4">Slip Gaji Terbit</h3>
                @if($myPayslips->isEmpty())
                    <p class="text-slate-400 text-sm">Belum ada slip gaji yang di-generate untuk Anda.</p>
                @else
                    <div class="space-y-3">
                        @foreach($myPayslips as $payslip)
                            <div class="flex items-center justify-between p-3 rounded-xl bg-slate-900/40 border border-slate-800/60">
                                <div>
                                    <p class="text-sm font-semibold text-slate-300">Bulan {{ $payslip->month }}</p>
                                    <p class="text-xs text-emerald-400">Rp {{ number_format($payslip->net_salary, 0, ',', '.') }}</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs px-2 py-0.5 rounded-full {{ $payslip->status === 'paid' ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : 'bg-amber-950 text-amber-400 border border-amber-800' }}">
                                        {{ strtoupper($payslip->status) }}
                                    </span>
                                    <a href="{{ route('payslips.show', $payslip->id) }}" target="_blank" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-xs transition">
                                        Lihat Slip
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @else
        <!-- Admin & Finance View -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Recent Transactions Table -->
            <div class="glass-panel rounded-2xl p-6 lg:col-span-2">
                <div class="flex justify-between items-center border-b border-slate-800 pb-4 mb-4">
                    <h3 class="font-bold text-lg text-slate-200">Transaksi Terbaru</h3>
                    <a href="{{ route('transactions.index', ['view' => 'history']) }}" class="text-xs text-blue-400 hover:underline">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="text-slate-400 border-b border-slate-800">
                                <th class="pb-2">Tanggal</th>
                                <th class="pb-2">Kategori</th>
                                <th class="pb-2">Deskripsi</th>
                                <th class="pb-2 text-right">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/40">
                            @foreach($recentTransactions as $tx)
                                <tr>
                                    <td class="py-3 text-slate-400">{{ $tx->date->format('d/m/Y') }}</td>
                                    <td class="py-3">
                                        <span class="text-xs px-2 py-0.5 rounded-full {{ $tx->type === 'income' ? 'bg-emerald-950/80 text-emerald-400' : 'bg-rose-950/80 text-rose-400' }}">
                                            {{ $tx->category->name }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-slate-300 truncate max-w-[150px]">{{ $tx->description ?? '-' }}</td>
                                    <td class="py-3 text-right font-semibold {{ $tx->type === 'income' ? 'text-emerald-400' : 'text-rose-400' }}">
                                        {{ $tx->type === 'income' ? '+' : '-' }} Rp {{ number_format($tx->amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                            @if($recentTransactions->isEmpty())
                                <tr>
                                    <td colspan="4" class="py-4 text-center text-slate-500">Belum ada transaksi tercatat.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Activity Audit Logs -->
            <div class="glass-panel rounded-2xl p-6">
                <h3 class="font-bold text-lg text-slate-200 border-b border-slate-800 pb-4 mb-4">Log Keamanan (Audit)</h3>
                <div class="space-y-4">
                    @foreach($auditLogs as $log)
                        <div class="border-b border-slate-800/50 pb-3 last:border-0 last:pb-0">
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-bold text-blue-400">{{ $log->action }}</span>
                                <span class="text-[10px] text-slate-500">{{ $log->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-xs text-slate-300 mt-1">{{ $log->description }}</p>
                            @if($log->user)
                                <p class="text-[10px] text-slate-500 mt-0.5">Oleh: {{ $log->user->name }}</p>
                            @endif
                        </div>
                    @endforeach
                    @if($auditLogs->isEmpty())
                        <p class="text-slate-500 text-xs text-center">Belum ada log aktivitas.</p>
                    @endif
                </div>
            </div>

        </div>
    @endif

@endsection

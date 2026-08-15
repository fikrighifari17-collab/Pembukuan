@extends('layouts.app')

@section('page_title', 'Payroll / Slip Gaji Karyawan')

@section('content')

    <div class="grid grid-cols-1 @if(!Auth::user()->isOwner()) lg:grid-cols-3 @endif gap-8">
        
        @if(!Auth::user()->isOwner())
        <!-- Generate Payroll Panel (Left 1 column) -->
        <div class="glass-panel p-6 rounded-2xl h-fit">
            <h3 class="font-bold text-lg text-slate-200 border-b border-slate-800 pb-4 mb-4">Generate Slip Gaji</h3>
            <form action="{{ route('payslips.generate') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Pilih Bulan</label>
                    <input type="month" name="month" value="{{ $selectedMonth }}" required class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Pilih Karyawan</label>
                    <select name="employee_id" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all">Semua Karyawan</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }} ({{ $employee->position }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Potongan per Hari Alpa (Rupiah)</label>
                    <input type="text" id="deduction_input" value="100.000" required class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="hidden" name="deduction_per_absent" id="deduction_hidden" value="100000">
                    <p class="text-[10px] text-slate-400 mt-1">Gaji Bersih = Gaji Pokok + Tunjangan - (Jumlah Alpa x Potongan)</p>
                </div>

                <button type="submit" class="w-full py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-medium transition duration-200">
                    Proses & Generate Slip
                </button>
            </form>
        </div>
        @endif

        <!-- Payroll list panel -->
        <div class="@if(Auth::user()->isOwner()) lg:col-span-3 @else lg:col-span-2 @endif glass-panel p-6 rounded-2xl">
            <div class="flex justify-between items-center border-b border-slate-800 pb-4 mb-4">
                <h3 class="font-bold text-lg text-slate-200">Daftar Payroll Bulan: <span class="text-blue-400 font-extrabold">{{ $selectedMonth }}</span></h3>
                
                <!-- Month Filter -->
                <form action="{{ route('payslips.index') }}" method="GET" class="flex items-center gap-2">
                    <input type="month" name="month" value="{{ $selectedMonth }}" onchange="this.form.submit()" class="px-3 py-1.5 rounded-xl bg-slate-900 border border-slate-800 text-xs text-white">
                </form>
            </div>

            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full min-w-[800px] text-left text-sm">
                    <thead>
                        <tr class="text-slate-400 border-b border-slate-800">
                            <th class="pb-2">Karyawan</th>
                            <th class="pb-2 text-right">Gaji Pokok</th>
                            <th class="pb-2 text-right">Potongan</th>
                            <th class="pb-2 text-right">Tunjangan</th>
                            <th class="pb-2 text-right">Lembur</th>
                            <th class="pb-2 text-right">Total Bersih</th>
                            <th class="pb-2 text-center">Status</th>
                            <th class="pb-2 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/40">
                        @foreach($payslips as $ps)
                            <tr class="hover:bg-slate-900/10 transition">
                                <td class="py-4 font-semibold text-slate-200">
                                    {{ $ps->employee->name }}
                                    <p class="text-[10px] text-slate-500 font-normal">{{ $ps->employee->position }}</p>
                                    @php
                                        $hadirCount = $ps->employee->attendances->whereIn('status', ['present', 'leave'])->count();
                                        $alpaCount = $ps->employee->attendances->where('status', 'absent')->count();
                                    @endphp
                                    <p class="text-[10px] text-slate-400 font-normal mt-1 bg-slate-900/50 px-2 py-0.5 rounded border border-slate-800/40 w-fit">
                                        <span class="text-emerald-400 font-semibold">{{ $hadirCount }} Hadir</span> | 
                                        <span class="text-rose-400 font-semibold">{{ $alpaCount }} Alpa</span>
                                    </p>
                                </td>
                                <td class="py-4 text-right text-slate-300">Rp {{ number_format($ps->base_salary, 0, ',', '.') }}</td>
                                <td class="py-4 text-right text-rose-400 font-medium">- Rp {{ number_format($ps->deductions, 0, ',', '.') }}</td>
                                <td class="py-4 text-right text-emerald-400 font-medium">+ Rp {{ number_format($ps->allowance, 0, ',', '.') }}</td>
                                <td class="py-4 text-right text-emerald-400 font-medium">+ Rp {{ number_format($ps->overtime_bonus, 0, ',', '.') }}</td>
                                <td class="py-4 text-right font-bold text-slate-100">Rp {{ number_format($ps->net_salary, 0, ',', '.') }}</td>
                                <td class="py-4 text-center">
                                    <span class="text-[10px] px-2 py-0.5 rounded-full font-bold uppercase {{ $ps->status === 'paid' ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : 'bg-amber-950 text-amber-400 border border-amber-800' }}">
                                        {{ $ps->status }}
                                    </span>
                                </td>
                                <td class="py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($ps->status === 'draft')
                                            <form action="{{ route('payslips.pay', $ps->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-2 py-1 rounded bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-semibold transition">
                                                    Bayar (Pay)
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('payslips.show', $ps->id) }}" target="_blank" class="px-2 py-1 rounded bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-semibold transition">
                                            Lihat PDF
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if($payslips->isEmpty())
                            <tr>
                                <td colspan="8" class="py-6 text-center text-slate-500">Belum ada slip gaji yang di-generate untuk bulan ini. Proses di panel kiri.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="block md:hidden space-y-4">
                @foreach($payslips as $ps)
                    @php
                        $hadirCount = $ps->employee->attendances->whereIn('status', ['present', 'leave'])->count();
                        $alpaCount = $ps->employee->attendances->where('status', 'absent')->count();
                    @endphp
                    <div class="p-4 rounded-2xl glass-panel space-y-3">
                        <div class="flex justify-between items-start border-b border-slate-800/40 pb-2">
                            <div>
                                <h4 class="font-bold text-slate-200 text-sm">{{ $ps->employee->name }}</h4>
                                <p class="text-[10px] text-slate-500">{{ $ps->employee->position }}</p>
                                <div class="flex gap-2 mt-1">
                                    <span class="text-[10px] text-emerald-400 font-semibold">{{ $hadirCount }} Hadir</span>
                                    <span class="text-slate-650">|</span>
                                    <span class="text-rose-400 font-semibold">{{ $alpaCount }} Alpa</span>
                                </div>
                            </div>
                            <span class="text-[9px] px-2 py-0.5 rounded-full font-bold uppercase {{ $ps->status === 'paid' ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : 'bg-amber-950 text-amber-400 border border-amber-800' }}">
                                {{ $ps->status }}
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-y-1.5 text-xs">
                            <div class="text-slate-400">Gaji Pokok:</div>
                            <div class="text-right text-slate-200">Rp {{ number_format($ps->base_salary, 0, ',', '.') }}</div>
                            
                            <div class="text-slate-400">Potongan:</div>
                            <div class="text-right text-rose-450 font-medium">- Rp {{ number_format($ps->deductions, 0, ',', '.') }}</div>
                            
                            <div class="text-slate-400">Tunjangan:</div>
                            <div class="text-right text-emerald-400 font-medium">+ Rp {{ number_format($ps->allowance, 0, ',', '.') }}</div>
                            
                            <div class="text-slate-400">Lembur:</div>
                            <div class="text-right text-emerald-400 font-medium">+ Rp {{ number_format($ps->overtime_bonus, 0, ',', '.') }}</div>
                            
                            <div class="text-slate-300 font-bold border-t border-slate-800/40 pt-2">Total Bersih:</div>
                            <div class="text-right font-bold text-[#FFBF00] border-t border-slate-800/40 pt-2">Rp {{ number_format($ps->net_salary, 0, ',', '.') }}</div>
                        </div>

                        <div class="flex justify-end gap-2 pt-2 border-t border-slate-800/40">
                            @if($ps->status === 'draft')
                                <form action="{{ route('payslips.pay', $ps->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-semibold transition">
                                        Bayar
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('payslips.show', $ps->id) }}" target="_blank" class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-semibold transition">
                                Lihat PDF
                            </a>
                        </div>
                    </div>
                @endforeach
                @if($payslips->isEmpty())
                    <p class="text-slate-500 text-xs text-center py-4">Belum ada slip gaji yang di-generate untuk bulan ini.</p>
                @endif
            </div>
        </div>

    </div>

    @if(!Auth::user()->isOwner())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deductionInput = document.getElementById('deduction_input');
            const deductionHidden = document.getElementById('deduction_hidden');

            if (deductionInput && deductionHidden) {
                deductionInput.addEventListener('input', function (e) {
                    let value = this.value.replace(/\D/g, '');
                    deductionHidden.value = value;
                    this.value = value ? formatNumber(value) : '';
                });
            }

            function formatNumber(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        });
    </script>
    @endif

@endsection

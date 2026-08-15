@extends('layouts.app')

@section('page_title', 'Manajemen Karyawan & Absensi')

@section('content')

    <div class="space-y-8">
        
        @if(Auth::user()->isHrd())
        <!-- Register Employee Profile Form (Top) -->
        <div class="glass-panel p-6 rounded-2xl">
                <h3 class="font-bold text-lg text-slate-200 border-b border-slate-800 pb-4 mb-4">Daftar Karyawan Baru</h3>
                <form action="{{ route('employees.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nama Lengkap</label>
                        <input type="text" name="name" required class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nama Karyawan">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Jabatan</label>
                        <input type="text" name="position" required class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Programmer, Designer">
                    </div>

                    @if(Auth::user()->isHrd())
                        <input type="hidden" name="base_salary" value="0">
                        <input type="hidden" name="allowance" value="0">
                    @else
                        <div>
                            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Gaji Pokok (Rupiah)</label>
                            <input type="text" id="base_salary_input" required class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-[#FFBF00]" placeholder="Contoh: 8.000.000">
                            <input type="hidden" name="base_salary" id="base_salary_hidden">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Tunjangan (Rupiah)</label>
                            <input type="text" id="allowance_input" required value="0" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-[#FFBF00]">
                            <input type="hidden" name="allowance" id="allowance_hidden" value="0">
                        </div>
                    @endif

                    <!-- Create User Account Toggle -->
                    <div class="border-t border-slate-800 pt-4">
                        <label class="flex items-center mb-3 cursor-pointer">
                            <input type="checkbox" name="create_user" value="1" checked id="create_user_toggle" class="w-4 h-4 rounded bg-slate-900 border-slate-700 text-[#FFBF00] focus:ring-[#FFBF00] focus:ring-offset-slate-900" onchange="toggleUserCreds(this)">
                            <span class="ml-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Buatkan Akun Login Website</span>
                        </label>

                        <div id="user_credentials_fields" class="space-y-3">
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Email Login</label>
                                <input type="email" name="email" id="email_field" class="w-full px-4 py-2 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="karyawan@perusahaan.com">
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Password Login</label>
                                <input type="password" name="password" id="password_field" class="w-full px-4 py-2 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Min. 6 Karakter">
                            </div>
                        </div>

                        <div id="existing_user_field" class="hidden">
                            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Pilih User Karyawan yang Ada</label>
                            <select name="user_id" id="user_id_select" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none">
                                <option value="">-- Pilih Akun --</option>
                                @foreach($availableUsers as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-medium transition duration-200">
                        Simpan & Daftarkan
                    </button>
                </form>
            </div>
        @endif

        <!-- Employees table (Bottom) -->
        <div class="glass-panel p-6 rounded-2xl">
                <h3 class="font-bold text-lg text-slate-200 border-b border-slate-800 pb-4 mb-4">Daftar Anggota Karyawan</h3>
                <!-- Desktop Table View -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full min-w-[650px] text-left text-sm">
                        <thead>
                            <tr class="text-slate-400 border-b border-slate-800">
                                <th class="pb-2">Nama</th>
                                <th class="pb-2">Jabatan</th>
                                @if(Auth::user()->isFinance())
                                    <th class="pb-2 text-right">Gaji Pokok</th>
                                    <th class="pb-2 text-right">Tunjangan</th>
                                    <th class="pb-2 text-right pr-4">Pengaturan Gaji</th>
                                @else
                                    <th class="pb-2 text-center">Hadir</th>
                                    <th class="pb-2 text-center">Izin/Cuti</th>
                                    <th class="pb-2 text-center">Alpa</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/40">
                            @foreach($employees as $emp)
                                <tr>
                                    <td class="py-3 text-slate-200 font-semibold">{{ $emp->name }}</td>
                                    <td class="py-3 text-slate-400">{{ $emp->position }}</td>
                                    @if(Auth::user()->isFinance())
                                        <td class="py-3 text-right text-slate-300">Rp {{ number_format($emp->base_salary, 0, ',', '.') }}</td>
                                        <td class="py-3 text-right text-slate-300">Rp {{ number_format($emp->allowance, 0, ',', '.') }}</td>
                                        <td class="py-3 text-right">
                                            <form action="{{ route('employees.update_salary', $emp->id) }}" method="POST" class="flex items-center justify-end gap-1.5">
                                                @csrf
                                                <div class="flex items-center gap-1">
                                                    <span class="text-[10px] text-slate-500">Gaji:</span>
                                                    <input type="number" name="base_salary" value="{{ (int)$emp->base_salary }}" required class="w-20 px-2 py-1 rounded bg-slate-900 border border-slate-700 text-xs text-white text-right focus:outline-none focus:ring-1 focus:ring-blue-500">
                                                </div>
                                                <div class="flex items-center gap-1">
                                                    <span class="text-[10px] text-slate-500">Tunj:</span>
                                                    <input type="number" name="allowance" value="{{ (int)$emp->allowance }}" required class="w-16 px-2 py-1 rounded bg-slate-900 border border-slate-700 text-xs text-white text-right focus:outline-none focus:ring-1 focus:ring-blue-500">
                                                </div>
                                                <button type="submit" class="px-2 py-1 bg-blue-600 hover:bg-blue-500 text-white rounded text-[10px] font-bold transition">Simpan</button>
                                            </form>
                                        </td>
                                    @else
                                        @php
                                            $activeMonth = date('Y-m', strtotime($selectedDate));
                                            $monthlyAttendances = $emp->attendances->filter(function($att) use ($activeMonth) {
                                                return str_starts_with($att->date, $activeMonth);
                                            });
                                            $presentDays = $monthlyAttendances->where('status', 'present')->count();
                                            $leaveDays = $monthlyAttendances->where('status', 'leave')->count();
                                            $absentDays = $monthlyAttendances->where('status', 'absent')->count();
                                        @endphp
                                        <td class="py-3 text-center text-emerald-400 font-bold">{{ $presentDays }} Hari</td>
                                        <td class="py-3 text-center text-amber-400 font-bold">{{ $leaveDays }} Hari</td>
                                        <td class="py-3 text-center text-rose-400 font-bold">{{ $absentDays }} Hari</td>
                                    @endif
                                </tr>
                            @endforeach
                            @if($employees->isEmpty())
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-slate-500">Belum ada profil karyawan terdaftar.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="block md:hidden space-y-4">
                    @foreach($employees as $emp)
                        <div class="p-4 rounded-xl bg-slate-900/20 border border-slate-800 space-y-3">
                            <div class="flex justify-between items-start border-b border-slate-800/40 pb-2">
                                <div>
                                    <h4 class="font-bold text-slate-200 text-sm">{{ $emp->name }}</h4>
                                    <p class="text-[10px] text-slate-500">{{ $emp->position }}</p>
                                </div>
                            </div>
                            
                            @if(Auth::user()->isFinance())
                                <div class="grid grid-cols-2 gap-y-1.5 text-xs pb-2 border-b border-slate-800/40">
                                    <div class="text-slate-400">Gaji Pokok:</div>
                                    <div class="text-right text-slate-200">Rp {{ number_format($emp->base_salary, 0, ',', '.') }}</div>
                                    
                                    <div class="text-slate-400">Tunjangan:</div>
                                    <div class="text-right text-slate-200">Rp {{ number_format($emp->allowance, 0, ',', '.') }}</div>
                                </div>

                                <form action="{{ route('employees.update_salary', $emp->id) }}" method="POST" class="space-y-2 pt-1">
                                    @csrf
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Update Gaji</p>
                                    <div class="grid grid-cols-2 gap-2">
                                        <div class="flex flex-col gap-1">
                                            <span class="text-[9px] text-slate-500">Gaji Pokok</span>
                                            <input type="number" name="base_salary" value="{{ (int)$emp->base_salary }}" required class="w-full px-2 py-1.5 rounded bg-slate-900 border border-slate-700 text-xs text-white">
                                        </div>
                                        <div class="flex flex-col gap-1">
                                            <span class="text-[9px] text-slate-500">Tunjangan</span>
                                            <input type="number" name="allowance" value="{{ (int)$emp->allowance }}" required class="w-full px-2 py-1.5 rounded bg-slate-900 border border-slate-700 text-xs text-white">
                                        </div>
                                    </div>
                                    <button type="submit" class="w-full py-1.5 bg-blue-600 hover:bg-blue-500 text-white rounded text-[10px] font-bold transition">Simpan Gaji</button>
                                </form>
                            @else
                                @php
                                    $activeMonth = date('Y-m', strtotime($selectedDate));
                                    $monthlyAttendances = $emp->attendances->filter(function($att) use ($activeMonth) {
                                        return str_starts_with($att->date, $activeMonth);
                                    });
                                    $presentDays = $monthlyAttendances->where('status', 'present')->count();
                                    $leaveDays = $monthlyAttendances->where('status', 'leave')->count();
                                    $absentDays = $monthlyAttendances->where('status', 'absent')->count();
                                @endphp
                                <div class="grid grid-cols-3 gap-2 text-center text-xs pt-1">
                                    <div class="p-1.5 rounded bg-emerald-950/20 border border-emerald-900/30">
                                        <span class="text-[9px] text-slate-500 block">Hadir</span>
                                        <span class="text-emerald-400 font-bold">{{ $presentDays }} Hari</span>
                                    </div>
                                    <div class="p-1.5 rounded bg-amber-950/20 border border-amber-900/30">
                                        <span class="text-[9px] text-slate-500 block">Izin</span>
                                        <span class="text-amber-400 font-bold">{{ $leaveDays }} Hari</span>
                                    </div>
                                    <div class="p-1.5 rounded bg-rose-950/20 border border-rose-800/30">
                                        <span class="text-[9px] text-slate-500 block">Alpa</span>
                                        <span class="text-rose-400 font-bold">{{ $absentDays }} Hari</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                    @if($employees->isEmpty())
                        <p class="text-slate-500 text-xs text-center py-4">Belum ada profil karyawan terdaftar.</p>
                    @endif
                </div>

    </div>

    <script>
        function toggleUserCreds(checkbox) {
            var creds = document.getElementById('user_credentials_fields');
            var existing = document.getElementById('existing_user_field');
            var emailF = document.getElementById('email_field');
            var passF = document.getElementById('password_field');
            var selectF = document.getElementById('user_id_select');

            if (checkbox.checked) {
                creds.classList.remove('hidden');
                existing.classList.add('hidden');
                emailF.setAttribute('required', 'required');
                passF.setAttribute('required', 'required');
                selectF.removeAttribute('required');
            } else {
                creds.classList.add('hidden');
                existing.classList.remove('hidden');
                emailF.removeAttribute('required');
                passF.removeAttribute('required');
                selectF.setAttribute('required', 'required');
            }
        }

        // Salary & Allowance auto dot formatter logic
        document.addEventListener('DOMContentLoaded', function () {
            const baseSalaryInput = document.getElementById('base_salary_input');
            const baseSalaryHidden = document.getElementById('base_salary_hidden');
            const allowanceInput = document.getElementById('allowance_input');
            const allowanceHidden = document.getElementById('allowance_hidden');

            function setupFormatter(inputEl, hiddenEl) {
                if (inputEl && hiddenEl) {
                    if (inputEl.value) {
                        let clean = inputEl.value.replace(/\D/g, '');
                        hiddenEl.value = clean;
                        inputEl.value = clean ? formatNumber(clean) : '';
                    }
                    
                    inputEl.addEventListener('input', function (e) {
                        let value = this.value.replace(/\D/g, '');
                        hiddenEl.value = value;
                        this.value = value ? formatNumber(value) : '';
                    });
                }
            }

            setupFormatter(baseSalaryInput, baseSalaryHidden);
            setupFormatter(allowanceInput, allowanceHidden);

            function formatNumber(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        });

        @if(session('print_attendance_date'))
            window.addEventListener('DOMContentLoaded', () => {
                setTimeout(() => {
                    window.open('{{ route("attendance.report", ["date" => session("print_attendance_date")]) }}', '_blank');
                }, 300);
            });
        @endif
    </script>

@endsection

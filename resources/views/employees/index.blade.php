@extends('layouts.app')

@section('page_title', 'Manajemen Karyawan & Absensi')

@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        @if(Auth::user()->isFinance())
        <!-- Register Employee Profile Form (Left 1 column) -->
        <div class="space-y-6">
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
        </div>
        @endif

        <!-- Attendance & Employees table (Right 2 columns) -->
        <div class="@if(Auth::user()->isFinance()) lg:col-span-2 @else lg:col-span-3 @endif space-y-8">
            
            <!-- Input Absensi Karyawan -->
            <div class="glass-panel p-6 rounded-2xl">
                <h3 class="font-bold text-lg text-slate-200 border-b border-slate-800 pb-4 mb-4">
                    @if(Auth::user()->isFinance()) Input Log Kehadiran Harian @else Log Kehadiran Harian @endif
                </h3>
                
                @if($employees->isEmpty())
                    <p class="text-slate-500 text-sm">Daftarkan karyawan terlebih dahulu sebelum menginput absensi.</p>
                @else
                    <form action="{{ route('attendance.log') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="flex items-center gap-4 mb-4">
                            <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Pilih Tanggal Absensi:</label>
                            <input type="date" name="date" value="{{ $selectedDate }}" required onchange="window.location.href='{{ route('employees.index') }}?date=' + this.value" class="px-4 py-2 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>

                        <!-- Desktop Table View -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="w-full min-w-[650px] text-left text-sm">
                                <thead>
                                    <tr class="text-slate-400 border-b border-slate-800">
                                        <th class="pb-2">Nama Karyawan</th>
                                        <th class="pb-2">Jabatan</th>
                                        <th class="pb-2 text-center">Hadir (Present)</th>
                                        <th class="pb-2 text-center">Alpa (Absent)</th>
                                        <th class="pb-2 text-center">Izin/Cuti (Leave)</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-800/40">
                                    @foreach($employees as $emp)
                                        @php
                                            $todayStr = $selectedDate;
                                            $todayAttendance = $emp->attendances->first(function($att) use ($todayStr) {
                                                return $att->date instanceof \Carbon\Carbon 
                                                    ? $att->date->format('Y-m-d') === $todayStr 
                                                    : $att->date === $todayStr;
                                            });
                                            $status = $todayAttendance ? $todayAttendance->status : 'present';
                                        @endphp
                                        <tr>
                                            <td class="py-3 text-slate-200 font-medium">{{ $emp->name }}</td>
                                            <td class="py-3 text-slate-400 text-xs">{{ $emp->position }}</td>
                                            <td class="py-3 text-center">
                                                @if(Auth::user()->isOwner())
                                                    @if($status === 'present')
                                                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-emerald-950 text-emerald-400 border border-emerald-800 text-xs font-bold">✓</span>
                                                    @else
                                                        <span class="text-slate-600">-</span>
                                                    @endif
                                                @else
                                                    <input type="radio" name="status[{{ $emp->id }}]" value="present" {{ $status === 'present' ? 'checked' : '' }} class="w-4 h-4 text-[#FFBF00] focus:ring-[#FFBF00] bg-slate-900 border-slate-700 focus:ring-offset-slate-900">
                                                @endif
                                            </td>
                                            <td class="py-3 text-center">
                                                @if(Auth::user()->isOwner())
                                                    @if($status === 'absent')
                                                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-rose-950 text-rose-400 border border-rose-800 text-xs font-bold">✗</span>
                                                    @else
                                                        <span class="text-slate-600">-</span>
                                                    @endif
                                                @else
                                                    <input type="radio" name="status[{{ $emp->id }}]" value="absent" {{ $status === 'absent' ? 'checked' : '' }} class="w-4 h-4 text-rose-500 focus:ring-rose-500 bg-slate-900 border-slate-700 focus:ring-offset-slate-900">
                                                @endif
                                            </td>
                                            <td class="py-3 text-center">
                                                @if(Auth::user()->isOwner())
                                                    @if($status === 'leave')
                                                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-amber-950 text-amber-400 border border-amber-800 text-xs font-bold">i</span>
                                                    @else
                                                        <span class="text-slate-600">-</span>
                                                    @endif
                                                @else
                                                    <input type="radio" name="status[{{ $emp->id }}]" value="leave" {{ $status === 'leave' ? 'checked' : '' }} class="w-4 h-4 text-amber-500 focus:ring-amber-500 bg-slate-900 border-slate-700 focus:ring-offset-slate-900">
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="block md:hidden space-y-4 mb-4">
                            @foreach($employees as $emp)
                                @php
                                    $todayStr = $selectedDate;
                                    $todayAttendance = $emp->attendances->first(function($att) use ($todayStr) {
                                        return $att->date instanceof \Carbon\Carbon 
                                            ? $att->date->format('Y-m-d') === $todayStr 
                                            : $att->date === $todayStr;
                                    });
                                    $status = $todayAttendance ? $todayAttendance->status : 'present';
                                @endphp
                                <div class="p-4 rounded-xl bg-slate-900/20 border border-slate-800/80 space-y-3">
                                    <div class="flex justify-between items-start border-b border-slate-800/40 pb-2">
                                        <div>
                                            <h4 class="font-bold text-slate-200 text-sm">{{ $emp->name }}</h4>
                                            <p class="text-[10px] text-slate-500">{{ $emp->position }}</p>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-2">Status Kehadiran:</label>
                                        @if(Auth::user()->isOwner())
                                            <div class="flex items-center gap-2">
                                                @if($status === 'present')
                                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-950 text-emerald-400 border border-emerald-800 uppercase">Hadir (Present)</span>
                                                @elseif($status === 'absent')
                                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-950 text-rose-400 border border-rose-800 uppercase">Alpa (Absent)</span>
                                                @else
                                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-950 text-amber-400 border border-amber-800 uppercase">Izin (Leave)</span>
                                                @endif
                                            </div>
                                        @else
                                            <div class="grid grid-cols-3 gap-2">
                                                <label class="flex flex-col items-center justify-center p-2 rounded-lg bg-slate-900/50 border border-slate-850 hover:border-blue-500/50 cursor-pointer transition">
                                                    <input type="radio" name="status[{{ $emp->id }}]" value="present" {{ $status === 'present' ? 'checked' : '' }} class="w-3.5 h-3.5 text-[#FFBF00] focus:ring-[#FFBF00] bg-slate-900 border-slate-700">
                                                    <span class="text-[10px] text-slate-300 mt-1 font-medium">Hadir</span>
                                                </label>
                                                <label class="flex flex-col items-center justify-center p-2 rounded-lg bg-slate-900/50 border border-slate-850 hover:border-rose-500/50 cursor-pointer transition">
                                                    <input type="radio" name="status[{{ $emp->id }}]" value="absent" {{ $status === 'absent' ? 'checked' : '' }} class="w-3.5 h-3.5 text-rose-500 focus:ring-rose-500 bg-slate-900 border-slate-700">
                                                    <span class="text-[10px] text-slate-300 mt-1 font-medium">Alpa</span>
                                                </label>
                                                <label class="flex flex-col items-center justify-center p-2 rounded-lg bg-slate-900/50 border border-slate-850 hover:border-amber-500/50 cursor-pointer transition">
                                                    <input type="radio" name="status[{{ $emp->id }}]" value="leave" {{ $status === 'leave' ? 'checked' : '' }} class="w-3.5 h-3.5 text-amber-500 focus:ring-amber-500 bg-slate-900 border-slate-700">
                                                    <span class="text-[10px] text-slate-300 mt-1 font-medium">Izin</span>
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if(Auth::user()->isFinance())
                        <button type="submit" class="w-full py-2.5 rounded-xl bg-[#FFBF00] hover:bg-[#ffd040] text-[#081d27] font-bold transition duration-200 uppercase tracking-wider text-xs shadow-lg shadow-[#FFBF00]/10">
                            Simpan Absensi Hari Ini
                        </button>
                        @endif
                    </form>
                @endif
            </div>

            <!-- List Karyawan Terdaftar -->
            <div class="glass-panel p-6 rounded-2xl">
                <h3 class="font-bold text-lg text-slate-200 border-b border-slate-800 pb-4 mb-4">Daftar Anggota Karyawan</h3>
                <!-- Desktop Table View -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full min-w-[650px] text-left text-sm">
                        <thead>
                            <tr class="text-slate-400 border-b border-slate-800">
                                <th class="pb-2">Nama</th>
                                <th class="pb-2">Jabatan</th>
                                <th class="pb-2 text-right">Gaji Pokok</th>
                                <th class="pb-2 text-right">Tunjangan</th>
                                <th class="pb-2 text-center">Total Absen Alpa</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/40">
                            @foreach($employees as $emp)
                                <tr>
                                    <td class="py-3 text-slate-200 font-semibold">{{ $emp->name }}</td>
                                    <td class="py-3 text-slate-400">{{ $emp->position }}</td>
                                    <td class="py-3 text-right text-slate-300">Rp {{ number_format($emp->base_salary, 0, ',', '.') }}</td>
                                    <td class="py-3 text-right text-slate-300">Rp {{ number_format($emp->allowance, 0, ',', '.') }}</td>
                                    <td class="py-3 text-center">
                                        <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $emp->attendances->where('status', 'absent')->count() > 0 ? 'bg-rose-950 text-rose-400' : 'bg-slate-900 text-slate-500' }}">
                                            {{ $emp->attendances->where('status', 'absent')->count() }} Hari
                                        </span>
                                    </td>
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
                        <div class="p-4 rounded-xl bg-slate-900/20 border border-slate-800 space-y-2.5">
                            <div class="flex justify-between items-start border-b border-slate-800/40 pb-2">
                                <div>
                                    <h4 class="font-bold text-slate-200 text-sm">{{ $emp->name }}</h4>
                                    <p class="text-[10px] text-slate-500">{{ $emp->position }}</p>
                                </div>
                                <span class="px-2.5 py-0.5 rounded-full text-[9px] font-bold {{ $emp->attendances->where('status', 'absent')->count() > 0 ? 'bg-rose-950 text-rose-455 border border-rose-800' : 'bg-slate-900 text-slate-500 border border-slate-800' }}">
                                    {{ $emp->attendances->where('status', 'absent')->count() }} Alpa
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-y-1.5 text-xs">
                                <div class="text-slate-400">Gaji Pokok:</div>
                                <div class="text-right text-slate-200">Rp {{ number_format($emp->base_salary, 0, ',', '.') }}</div>
                                
                                <div class="text-slate-400">Tunjangan:</div>
                                <div class="text-right text-slate-200">Rp {{ number_format($emp->allowance, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    @endforeach
                    @if($employees->isEmpty())
                        <p class="text-slate-500 text-xs text-center py-4">Belum ada profil karyawan terdaftar.</p>
                    @endif
                </div>
            </div>

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
    </script>

@endsection

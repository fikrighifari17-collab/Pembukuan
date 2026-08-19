<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ADMS PEMBUKUAN</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --navy-primary: #0F3040;
            --navy-dark: #081d27;
            --navy-light: #164257;
            --emas: #FFBF00;
        }
        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--navy-dark);
            color: #f1f5f9;
        }
        .glass-panel {
            background: rgba(15, 48, 64, 0.5);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 191, 0, 0.08);
        }
    </style>
</head>
<body class="h-screen flex overflow-hidden">

    <!-- LEFT SIDE: Login input panel (5/12 width on desktop) -->
    <div class="w-full md:w-5/12 bg-[#081d27] flex flex-col justify-between p-8 md:p-12 overflow-y-auto border-r border-slate-800/40">
        
        <!-- Header Brand logo -->
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="ADMS Logo" class="h-8 w-auto object-contain shrink-0 filter drop-shadow">
            <span class="text-[11px] font-black tracking-wider text-[#FFBF00] uppercase leading-none">ADMS PEMBUKUAN</span>
        </div>

        <!-- Center Login Form -->
        <div class="my-auto py-8">
            <div class="mb-8">
                <h2 class="text-3xl font-black text-white tracking-tight uppercase">LOGIN MASUK</h2>
                <p class="text-slate-400 text-xs mt-1">Silakan masukkan akun Anda untuk mengakses sistem pembukuan</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-3 rounded-xl bg-slate-900/60 border border-slate-700/80 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#FFBF00] focus:border-transparent transition duration-200 text-sm" placeholder="nama@perusahaan.com">
                    @error('email')
                        <p class="text-rose-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Password</label>
                    <input type="password" name="password" id="password" required class="w-full px-4 py-3 rounded-xl bg-slate-900/60 border border-slate-700/80 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#FFBF00] focus:border-transparent transition duration-200 text-sm" placeholder="••••••••">
                    @error('password')
                        <p class="text-rose-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded bg-slate-900 border-slate-700 text-[#FFBF00] focus:ring-[#FFBF00] focus:ring-offset-slate-900 transition duration-150">
                    <label for="remember" class="ml-2 text-xs text-slate-400 cursor-pointer">Ingat perangkat ini</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 rounded-xl bg-[#FFBF00] text-[#081d27] font-bold hover:bg-[#ffd040] focus:outline-none focus:ring-2 focus:ring-[#FFBF00] focus:ring-offset-2 focus:ring-offset-slate-900 transition duration-300 transform hover:scale-[1.01] active:scale-[0.99] shadow-lg shadow-[#FFBF00]/15 text-sm uppercase tracking-wider">
                    Login Masuk
                </button>
            </form>
        </div>


    </div>

    <!-- RIGHT SIDE: Premium Brand Showcase (7/12 width on desktop) -->
    <div class="hidden md:flex md:w-7/12 bg-[#0F3040] items-center justify-center p-12 relative overflow-hidden">
        
        <!-- Glowing gradient layers in background -->
        <div class="absolute -right-32 -bottom-32 w-96 h-96 rounded-full bg-[#FFBF00]/5 blur-3xl"></div>
        <div class="absolute -left-32 -top-32 w-96 h-96 rounded-full bg-slate-950/30 blur-3xl"></div>

        <!-- Branding card details -->
        <div class="relative z-10 text-center space-y-6 max-w-lg">
            <div class="w-64 h-40 mx-auto flex items-center justify-center mb-6 transition-transform hover:scale-105 duration-300">
                <img src="{{ asset('images/logo.png') }}" alt="ADMS Logo" class="max-h-full max-w-full object-contain filter drop-shadow-2xl">
            </div>
            
            <h1 class="text-4xl lg:text-5xl font-black text-[#FFBF00] tracking-tight uppercase leading-none">ADMS PEMBUKUAN</h1>
            <p class="text-xs lg:text-sm text-slate-300 tracking-widest font-semibold uppercase leading-snug">PT ARMADA DIGITAL MARKETING SYARIAH</p>
            <div class="w-16 h-1 bg-[#FFBF00] mx-auto rounded-full"></div>
            <p class="text-slate-400 text-xs max-w-sm mx-auto leading-relaxed">Sistem Keuangan & Operasional Syariah Internal Perusahaan Terintegrasi.</p>
        </div>
    </div>

</body>
</html>

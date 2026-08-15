<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEMBUKUAN PT ARMADA DIGITAL MARKETING SYARIAH</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --navy-primary: #0F3040;
            --navy-dark: #081d27;
            --navy-light: #164257;
            --emas: #FFBF00;
            --bg-color: var(--navy-dark);
            --text-color: #f1f5f9;
            --panel-bg: rgba(15, 48, 64, 0.65);
            --panel-border: rgba(255, 191, 0, 0.08);
            --input-bg: rgba(10, 30, 40, 0.6);
            --input-border: rgba(255, 191, 0, 0.15);
            --text-slate-400: #94a3b8;
            --text-slate-200: #e2e8f0;
            --text-slate-300: #cbd5e1;
            --border-slate-800: rgba(255, 255, 255, 0.06);
        }
        body.light-theme {
            --navy-dark: #f8fafc;
            --navy-light: #ffffff;
            --bg-color: #f1f5f9;
            --text-color: #0f172a;
            --panel-bg: rgba(255, 255, 255, 0.85);
            --panel-border: rgba(15, 48, 64, 0.08);
            --input-bg: #ffffff;
            --input-border: rgba(15, 48, 64, 0.15);
            --text-slate-400: #475569;
            --text-slate-200: #0f172a;
            --text-slate-300: #334155;
            --border-slate-800: rgba(15, 48, 64, 0.08);
            --emas: #b37d00;
        }
        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.3s, color 0.3s;
        }
        .glass-panel {
            background: var(--panel-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--panel-border);
            transition: background 0.3s, border-color 0.3s;
        }

        /* Light Theme Overrides */
        body.light-theme .text-slate-400 { color: var(--text-slate-400) !important; }
        body.light-theme .text-slate-200 { color: var(--text-slate-200) !important; }
        body.light-theme .text-slate-300 { color: var(--text-slate-300) !important; }
        body.light-theme .text-slate-100 { color: #0f172a !important; }
        body.light-theme .text-slate-500 { color: #64748b !important; }
        body.light-theme .text-white { color: #0f172a !important; }
        body.light-theme .bg-slate-900 { background-color: var(--navy-light) !important; }
        body.light-theme .bg-slate-900\/60 { background-color: rgba(15, 48, 64, 0.04) !important; }
        body.light-theme .bg-slate-900\/50 { background-color: rgba(15, 48, 64, 0.03) !important; }
        body.light-theme .bg-slate-900\/40 { background-color: rgba(15, 48, 64, 0.03) !important; }
        body.light-theme .bg-slate-900\/20 { background-color: rgba(15, 48, 64, 0.015) !important; }
        body.light-theme .bg-slate-900\/10 { background-color: rgba(15, 48, 64, 0.01) !important; }
        body.light-theme .bg-slate-950\/40 { background-color: #f1f5f9 !important; }
        body.light-theme .border-slate-800 { border-color: var(--border-slate-800) !important; }
        body.light-theme .border-slate-700 { border-color: var(--input-border) !important; }
        body.light-theme .hover\:bg-slate-900\/10:hover { background-color: rgba(15, 48, 64, 0.04) !important; }
        body.light-theme input:not([type="radio"]):not([type="checkbox"]), body.light-theme select, body.light-theme textarea {
            background-color: var(--input-bg) !important;
            border-color: var(--input-border) !important;
            color: var(--text-color) !important;
        }
        body.light-theme input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 30px #ffffff inset !important;
            -webkit-text-fill-color: #0f172a !important;
        }

        /* Light Theme Status Badges & Text Softening */
        body.light-theme .bg-emerald-950, body.light-theme .bg-emerald-950\/80 { background-color: #d1fae5 !important; }
        body.light-theme .text-emerald-400 { color: #047857 !important; }
        body.light-theme .border-emerald-800 { border-color: #a7f3d0 !important; }

        body.light-theme .bg-rose-950, body.light-theme .bg-rose-950\/80 { background-color: #ffe4e6 !important; }
        body.light-theme .text-rose-400 { color: #b91c1c !important; }
        body.light-theme .border-rose-800 { border-color: #fecdd3 !important; }

        body.light-theme .bg-amber-950 { background-color: #fef3c7 !important; }
        body.light-theme .text-amber-400 { color: #b45309 !important; }
        body.light-theme .border-amber-800 { border-color: #fde68a !important; }

        body.light-theme .bg-violet-950 { background-color: #f3e8ff !important; }
        body.light-theme .text-violet-400 { color: #6d28d9 !important; }
        body.light-theme .border-violet-800 { border-color: #e9d5ff !important; }

        body.light-theme .text-blue-400 { color: #1d4ed8 !important; }
        body.light-theme .text-blue-300 { color: #1e40af !important; }

        /* Soften the card borders on light theme */
        body.light-theme .border-violet-500 { border-color: #a78bfa !important; }
        body.light-theme .border-emerald-500 { border-color: #6ee7b7 !important; }
        body.light-theme .border-rose-500 { border-color: #fca5a5 !important; }
        body.light-theme .border-blue-500 { border-color: #93c5fd !important; }
        body.light-theme .border-amber-500 { border-color: #fde68a !important; }

        /* Category selection Segment overrides in Light Mode */
        body.light-theme .category-choice-box {
            background-color: #ffffff !important;
            border-color: rgba(15, 48, 64, 0.15) !important;
            color: #64748b !important;
        }
        body.light-theme .category-choice-box:hover {
            background-color: #f8fafc !important;
        }
        body.light-theme .peer:checked + .category-choice-income {
            background-color: #d1fae5 !important;
            border-color: #10b981 !important;
            color: #047857 !important;
        }
        body.light-theme .peer:checked + .category-choice-expense {
            background-color: #ffe4e6 !important;
            border-color: #f43f5e !important;
            color: #be123c !important;
        }

        /* Hide scrollbars visually but keep scrolling functional */
        .overflow-x-auto::-webkit-scrollbar {
            display: none !important;
        }
        .overflow-x-auto {
            -ms-overflow-style: none !important;  /* IE and Edge */
            scrollbar-width: none !important;  /* Firefox */
        }

        /* Attendance Radio custom styles to ensure high contrast in checked state on both themes */
        input[type="radio"].attendance-radio {
            background-color: rgba(10, 30, 40, 0.6) !important;
            border-color: rgba(255, 191, 0, 0.15) !important;
        }
        input[type="radio"].attendance-radio:checked {
            background-color: currentColor !important;
            border-color: transparent !important;
        }

        body.light-theme input[type="radio"].attendance-radio {
            background-color: #ffffff !important;
            border-color: rgba(15, 48, 64, 0.15) !important;
        }
        body.light-theme input[type="radio"].attendance-radio:checked {
            background-color: currentColor !important;
            border-color: transparent !important;
        }

        /* Dynamic Theme Overrides */
        .bg-blue-600 {
            background-color: var(--emas) !important;
            color: var(--navy-dark) !important;
        }
        .bg-blue-600 svg {
            color: var(--navy-dark) !important;
        }
        .hover\:bg-blue-500:hover {
            background-color: #ffd040 !important;
            color: var(--navy-dark) !important;
        }
        .text-blue-400 {
            color: var(--emas) !important;
        }
        .text-blue-300 {
            color: var(--emas) !important;
        }
        .bg-blue-900\/60 {
            background-color: rgba(255, 191, 0, 0.15) !important;
            color: var(--emas) !important;
        }
        .shadow-blue-500\/20 {
            box-shadow: 0 10px 15px -3px rgba(255, 191, 0, 0.25) !important;
        }
        .shadow-blue-500\/10 {
            box-shadow: 0 4px 6px -1px rgba(255, 191, 0, 0.15) !important;
        }
        .border-blue-500 {
            border-color: var(--emas) !important;
        }
        .focus\:ring-blue-500:focus {
            --tw-ring-color: var(--emas) !important;
        }
        .bg-slate-900\/40 {
            background-color: rgba(10, 30, 40, 0.5) !important;
        }
        .bg-slate-900 {
            background-color: var(--navy-dark) !important;
        }
        .border-slate-800 {
            border-color: rgba(255, 255, 255, 0.06) !important;
        }
        .border-slate-700 {
            border-color: rgba(255, 191, 0, 0.15) !important;
        }

        /* Prevent browser autofill style override */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #081d27 inset !important;
            -webkit-text-fill-color: #f1f5f9 !important;
            transition: background-color 5000s ease-in-out 0s;
        }
        /* Collapsible Sidebar Styles */
        .sidebar-collapsed {
            width: 5rem !important; /* w-20 */
        }
        .sidebar-collapsed .sidebar-text {
            display: none !important;
        }
        .sidebar-collapsed .sidebar-full-info {
            display: none !important;
        }
        .sidebar-collapsed .sidebar-collapsed-info {
            display: block !important;
        }
        .sidebar-collapsed nav a {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        /* Mobile drawer styling */
        @media (max-width: 768px) {
            #sidebar {
                position: fixed;
                height: 100vh;
                left: -16rem;
                z-index: 50;
                width: 16rem !important;
                box-shadow: 10px 0 30px rgba(0,0,0,0.5);
            }
            #sidebar.sidebar-mobile-open {
                left: 0;
            }
            /* Override desktop-collapsed properties on mobile viewports */
            #sidebar .sidebar-text {
                display: block !important;
            }
            #sidebar .sidebar-full-info {
                display: block !important;
            }
            #sidebar .sidebar-collapsed-info {
                display: none !important;
            }
            #sidebar nav a {
                justify-content: flex-start !important;
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
            #sidebar .p-6 {
                justify-content: space-between !important;
            }
            #sidebar form button {
                justify-content: flex-start !important;
                padding-left: 0.75rem !important;
                padding-right: 0.75rem !important;
            }
            .sidebar-overlay {
                position: fixed;
                inset: 0;
                background: rgba(8, 29, 39, 0.6);
                backdrop-filter: blur(4px);
                z-index: 40;
                display: none;
            }
            .sidebar-overlay.active {
                display: block;
            }
            main {
                width: 100%;
            }
        }
        
        .sidebar-collapsed .p-6 {
            justify-content: center;
        }
        .sidebar-collapsed form button {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }
    </style>
</head>
<body class="h-screen flex overflow-hidden">

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="sidebar-overlay"></div>
    <aside id="sidebar" class="w-64 glass-panel border-r border-slate-800 flex flex-col shrink-0 transition-all duration-300">
        <div class="p-6 border-b border-slate-800 flex items-center justify-between">
            <div class="sidebar-full-info flex-1 pr-2">
                <h1 class="text-lg font-black text-[#FFBF00] flex items-center gap-1.5 leading-none uppercase">
                    <svg class="w-5 h-5 text-[#FFBF00] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>PEMBUKUAN</span>
                </h1>
                <p class="text-[9px] font-bold text-slate-200 mt-1 uppercase tracking-wide leading-tight">PT ARMADA DIGITAL MARKETING SYARIAH</p>
                <p class="text-[8px] text-slate-400 mt-0.5 uppercase tracking-widest font-semibold">Sistem Keuangan Internal</p>
            </div>
            <button id="btn-toggle-sidebar" class="text-slate-400 hover:text-white focus:outline-none transition duration-200 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>

        <nav class="flex-1 p-4 space-y-1">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white font-medium shadow-lg shadow-blue-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}" title="Dashboard">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="sidebar-text">Dashboard</span>
            </a>

            @if(Auth::user()->isOwner() || Auth::user()->isFinance())
                <a href="{{ route('transactions.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('transactions.index') ? 'bg-blue-600 text-white font-medium shadow-lg shadow-blue-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}" title="Pencatatan Keuangan">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    <span class="sidebar-text">Pencatatan Keuangan</span>
                </a>
            @endif

            <a href="{{ route('purchase_requests.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('purchase_requests.index') ? 'bg-blue-600 text-white font-medium shadow-lg shadow-blue-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}" title="Request Pembelian">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <span class="sidebar-text">Request Pembelian</span>
            </a>

            @if(Auth::user()->isOwner() || Auth::user()->isFinance())
                <a href="{{ route('payslips.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('payslips.index') ? 'bg-blue-600 text-white font-medium shadow-lg shadow-blue-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}" title="Payroll / Slip Gaji">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span class="sidebar-text">Payroll / Slip Gaji</span>
                </a>
            @endif

            @if(Auth::user()->isOwner() || Auth::user()->isHrd())
                <a href="{{ route('employees.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('employees.index') ? 'bg-blue-600 text-white font-medium shadow-lg shadow-blue-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}" title="Kelola Karyawan & Absen">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span class="sidebar-text">Kelola Karyawan & Absen</span>
                </a>
            @endif
        </nav>

        <!-- User section -->
        <div class="p-4 border-t border-slate-800 bg-slate-900/50">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-full bg-blue-500/20 text-blue-400 flex items-center justify-center font-bold shrink-0">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="overflow-hidden sidebar-text">
                    <h2 class="text-sm font-semibold truncate">{{ Auth::user()->name }}</h2>
                    <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded-full bg-blue-900/60 text-blue-300">
                        {{ Auth::user()->role }}
                    </span>
                </div>
            </div>
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left flex items-center gap-2 px-3 py-2 text-xs text-rose-400 hover:bg-rose-500/10 rounded-lg transition duration-150" title="Logout">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span class="sidebar-text">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-w-0">
        <!-- Top bar -->
        <header class="h-16 border-b border-slate-800 flex items-center justify-between px-8 bg-slate-900/20 backdrop-blur-md">
            <div class="flex items-center">
                <button id="btn-mobile-menu" class="md:hidden text-slate-400 hover:text-white mr-4 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <h2 class="text-base md:text-lg font-semibold">@yield('page_title', 'Sistem Pembukuan')</h2>
            </div>
            <div class="flex items-center gap-4">
                <button id="btn-theme-toggle" class="p-2 rounded-xl bg-slate-900/40 border border-slate-800 text-slate-450 hover:text-[#FFBF00] transition duration-200 focus:outline-none" title="Ubah Tema (Terang/Gelap)">
                    <!-- Sun Icon (shown in dark theme) -->
                    <svg id="theme-icon-sun" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"></path></svg>
                    <!-- Moon Icon (shown in light theme) -->
                    <svg id="theme-icon-moon" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </button>
                <div class="text-xs text-slate-400 hidden sm:block">
                    Tanggal Hari Ini: {{ now()->translatedFormat('d F Y') }}
                </div>
            </div>
        </header>

        <!-- Page body -->
        <div class="flex-1 p-4 md:p-8 overflow-y-auto">
            @if(session('success'))
                <div class="toast-notification mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm flex items-center gap-2 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="toast-notification mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-400 text-sm flex items-center gap-2 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Sidebar Toggle & Notification Scripts -->
    <script>
        // Collapsible Sidebar logic
        const sidebar = document.getElementById('sidebar');
        const btnToggleSidebar = document.getElementById('btn-toggle-sidebar');
        const btnMobileMenu = document.getElementById('btn-mobile-menu');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        // Check persistent state from localStorage
        if (localStorage.getItem('sidebar-collapsed') === 'true') {
            sidebar.classList.add('sidebar-collapsed');
        }

        btnToggleSidebar.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('sidebar-mobile-open');
                sidebarOverlay.classList.remove('active');
            } else {
                sidebar.classList.toggle('sidebar-collapsed');
                const isCollapsed = sidebar.classList.contains('sidebar-collapsed');
                localStorage.setItem('sidebar-collapsed', isCollapsed);
            }
        });

        // Mobile Menu toggle bindings
        if (btnMobileMenu) {
            btnMobileMenu.addEventListener('click', () => {
                sidebar.classList.add('sidebar-mobile-open');
                sidebarOverlay.classList.add('active');
            });
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', () => {
                sidebar.classList.remove('sidebar-mobile-open');
                sidebarOverlay.classList.remove('active');
            });
        }

        // Toast Notification Auto-Fadeout (3 seconds)
        document.querySelectorAll('.toast-notification').forEach((toast) => {
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 3000);
        });

        // Theme Toggle logic
        const btnThemeToggle = document.getElementById('btn-theme-toggle');
        const sunIcon = document.getElementById('theme-icon-sun');
        const moonIcon = document.getElementById('theme-icon-moon');

        if (btnThemeToggle) {
            // Apply theme on load
            if (localStorage.getItem('theme-mode') === 'light') {
                document.body.classList.add('light-theme');
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            }

            btnThemeToggle.addEventListener('click', () => {
                document.body.classList.toggle('light-theme');
                const isLight = document.body.classList.contains('light-theme');
                localStorage.setItem('theme-mode', isLight ? 'light' : 'dark');
                
                if (isLight) {
                    sunIcon.classList.add('hidden');
                    moonIcon.classList.remove('hidden');
                } else {
                    sunIcon.classList.remove('hidden');
                    moonIcon.classList.add('hidden');
                }
            });
        }
    </script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Swim Base')</title>

    {{-- Font & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#D92323',
                        dark: '#0f172a',
                        darker: '#020617',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body { background-color: #0f172a; color: white; overflow-x: hidden; }

        /* NAVBAR GLASSMORPHISM */
        nav {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        /* PERBAIKAN DROPDOWN AGAR TIDAK HILANG */
        .dropdown-container {
            position: relative;
            padding-bottom: 20px; /* Jembatan agar kursor tidak lepas */
            margin-bottom: -20px;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            width: 230px;
            background: #1e293b;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            z-index: 1000;
            overflow: hidden;
            margin-top: -10px; /* Menempel ke tombol */
        }

        .dropdown-container:hover .dropdown-menu {
            display: block;
            animation: fadeIn 0.2s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .nav-link { position: relative; }
        .nav-link::after {
            content: ''; position: absolute; width: 0; height: 2px;
            background: #D92323; bottom: -4px; left: 0; transition: 0.3s;
        }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }

        #mobile-menu { transition: max-height 0.3s ease-in-out; max-height: 0; overflow: hidden; }
        #mobile-menu.open { max-height: 500px; }
    </style>
</head>

<body class="bg-dark text-white font-sans antialiased">

    {{-- NAVBAR --}}
    <nav class="fixed w-full z-50 top-0 left-0 px-6 py-4 flex justify-between items-center">
        
        {{-- LOGO --}}
        <a href="{{ url('/') }}" class="flex items-center gap-3 group">
            <img src="{{ asset('images/logo.png') }}" alt="SwimBase" class="h-10 w-auto">
            <div class="text-xl font-bold tracking-wide">
                SWIM BASE <span class="text-primary">ID</span>
            </div>
        </a>

        {{-- MENU DESKTOP --}}
        <ul class="hidden md:flex items-center gap-8">
            <li><a href="{{ url('/') }}" class="nav-link text-gray-300 hover:text-white font-medium {{ Request::is('/') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ route('events.list') }}" class="nav-link text-gray-300 hover:text-white font-medium {{ request()->routeIs('events*') ? 'active' : '' }}">Event</a></li>
            <li><a href="{{ route('athletes.index') }}" class="nav-link text-gray-300 hover:text-white font-medium {{ request()->routeIs('athletes*') ? 'active' : '' }}">Atlet</a></li>
            <li><a href="{{ route('achievements.index') }}" class="nav-link text-gray-300 hover:text-white font-medium {{ request()->routeIs('achievements*') ? 'active' : '' }}">Prestasi</a></li>
        </ul>

        {{-- LOGIN / DASHBOARD --}}
        <div class="hidden md:block">
            @php
                // Cek apakah ada guard yang login
                $isLoggedIn = auth()->guard('super_admin')->check() || 
                              auth()->guard('admin')->check() || 
                              auth()->guard('club')->check() || 
                              auth()->guard('institution')->check();
            @endphp

            @if($isLoggedIn)
                {{-- TAMPILAN DASHBOARD (JIKA LOGIN) --}}
                <a href="{{ route('dashboard') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-2 rounded-full font-semibold transition-all flex items-center gap-2">
                    <i class="fas fa-user-circle"></i> Dashboard
                </a>
            @else
                {{-- TAMPILAN MASUK (JIKA GUEST) --}}
                <div class="dropdown-container">
                    <button class="bg-primary hover:bg-red-700 text-white px-6 py-2 rounded-full font-semibold transition-all flex items-center gap-2">
                        Masuk <i class="fas fa-chevron-down text-xs"></i>
                    </button>

                    <div class="dropdown-menu">
                        <div class="px-4 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-white/5">
                            Pilih Portal Akses
                        </div>
                        <a href="{{ route('institution.login') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-300 hover:bg-primary hover:text-white transition-colors">
                            <i class="fas fa-school w-5 text-center"></i> Sekolah / Univ
                        </a>
                        <a href="{{ route('club.login') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-300 hover:bg-primary hover:text-white transition-colors">
                            <i class="fas fa-swimmer w-5 text-center"></i> Klub Renang
                        </a>
                        <a href="{{ route('admin.login') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-300 hover:bg-primary hover:text-white transition-colors">
                            <i class="fas fa-user-tie w-5 text-center"></i> Admin Event
                        </a>
                        <a href="{{ route('superadmin.login') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-300 hover:bg-primary hover:text-white transition-colors">
                            <i class="fas fa-shield-alt w-5 text-center"></i> Super Admin
                        </a>
                    </div>
                </div>
            @endif
        </div>

        {{-- MOBILE BUTTON --}}
        <button onclick="toggleMobileMenu()" class="md:hidden text-2xl text-white">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    {{-- MOBILE MENU --}}
    <div id="mobile-menu" class="md:hidden fixed w-full bg-slate-900 border-b border-slate-800 z-40 top-[73px]">
        <ul class="flex flex-col p-4 space-y-2">
            <li><a href="{{ url('/') }}" class="block px-4 py-2 text-gray-300">Beranda</a></li>
            <li><a href="{{ route('events.list') }}" class="block px-4 py-2 text-gray-300">Event</a></li>
            <li><a href="{{ route('login') }}" class="block px-4 py-2 mt-2 bg-primary text-center rounded text-white font-bold">Masuk</a></li>
        </ul>
    </div>

    {{-- MAIN CONTENT --}}
    <main class="min-h-screen pt-20">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-darker border-t border-slate-800 py-10 mt-20">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <img src="{{ asset('images/logo.png') }}" class="h-12 mx-auto mb-4 opacity-75">
            <p class="text-slate-400 mb-6 font-light">Swim Base Indonesia — Digital Swimming Management.</p>
            <div class="text-slate-600 text-sm">&copy; {{ date('Y') }} Swim Base ID.</div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('open');
            menu.style.maxHeight = menu.classList.contains('open') ? menu.scrollHeight + "px" : "0";
        }
    </script>
</body>
</html>
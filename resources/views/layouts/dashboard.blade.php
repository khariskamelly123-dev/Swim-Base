<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SwimBase Dashboard')</title>

    {{-- Tailwind & Icons --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: #94a3b8; }
    </style>
    @yield('styles')
</head>

<body class="bg-gray-50 text-gray-800 antialiased overflow-hidden">

    {{-- WRAPPER UTAMA --}}
    <div class="flex flex-col h-screen">

        {{-- 1. HEADER ATAS (Global Topbar) --}}
        <nav class="h-16 bg-black px-8 flex justify-between items-center flex-shrink-0 z-50">
            {{-- Logo --}}
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" class="h-8" onerror="this.src='https://ui-avatars.com/api/?name=SB&background=D92323&color=fff'">
                <span class="text-white text-xl font-bold tracking-tight">Swim Base <span class="text-red-600">ID</span></span>
            </div>

            {{-- Search & Info --}}
            <div class="flex items-center gap-6">
                <div class="hidden md:flex items-center gap-3 text-white bg-gray-900 px-4 py-1.5 rounded-full border border-gray-700">
                    <i class="fas fa-search text-gray-400 text-sm"></i>
                    <input type="search" placeholder="Cari data..." class="bg-transparent border-none text-sm text-white focus:ring-0 focus:outline-none w-48 placeholder-gray-500">
                </div>
                {{-- Status User --}}
                <div class="text-white text-xs font-medium bg-gray-800 px-3 py-1 rounded-md border border-gray-700">
                    Mode: 
                    @if(auth()->guard('super_admin')->check()) Super Admin
                    @elseif(auth()->guard('admin')->check()) Admin Event
                    @elseif(auth()->guard('club')->check()) Klub
                    @else Institusi @endif
                </div>
            </div>
        </nav>

        {{-- 2. AREA TENGAH (Sidebar + Content) --}}
        <div class="flex flex-1 overflow-hidden">
            
            {{-- SIDEBAR DINAMIS --}}
            @if(auth()->guard('super_admin')->check())
                @include('layouts.sidebar.super_admin')
            @elseif(auth()->guard('admin')->check())
                @include('layouts.sidebar.admin')
            @elseif(auth()->guard('club')->check())
                @include('layouts.sidebar.club')
            @elseif(auth()->guard('institution')->check())
                @include('layouts.sidebar.institution')
            @endif

            {{-- CONTENT AREA --}}
            <div class="flex-1 flex flex-col overflow-hidden bg-[#F9FAFB]">
                <main class="flex-1 overflow-y-auto custom-scrollbar">
                    {{-- Pesan Alert Global (Optional) --}}
                    @if(session('success'))
                        <div class="mx-8 mt-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-3 text-sm">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    @yield('content')
                </main>
            </div>

        </div>
    </div>

    @yield('scripts')
</body>
</html>
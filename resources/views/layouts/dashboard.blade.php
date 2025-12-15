<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SwimBase Dashboard')</title>

    {{-- 1. TAILWIND CSS & FONTAWESOME (Wajib ada) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    {{-- 2. FONT & CUSTOM STYLE --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Custom Scrollbar untuk sidebar & konten */
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: #94a3b8; }
    </style>
    @yield('styles')
</head>

<body class="bg-gray-50 text-gray-800 antialiased overflow-hidden">

    {{-- WRAPPER UTAMA: Flex Column (Header di atas, Sisanya di bawah) --}}
    <div class="flex flex-col h-screen">

        {{-- A. HEADER HITAM (Global Topbar) --}}
        {{-- Menggunakan Tailwind: h-16 (64px), bg-black, flex, dll --}}
        <nav class="h-16 bg-black px-8 flex justify-between items-center flex-shrink-0 z-50">
            {{-- Logo --}}
            <div class="flex items-center gap-3">
                {{-- Fallback jika gambar logo tidak ada, pakai icon --}}
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ asset('images/logo.png') }}" class="h-8">
                @else
                    <i class="fas fa-swimmer text-white text-2xl"></i>
                @endif
                <span class="text-white text-xl font-bold tracking-tight">Swim Base</span>
            </div>

            {{-- Search Bar (Header Atas) --}}
            <div class="hidden md:flex items-center gap-3 text-white bg-gray-900 px-4 py-1.5 rounded-full border border-gray-700">
                <i class="fas fa-search text-gray-400 text-sm"></i>
                <input type="search" placeholder="Search..." class="bg-transparent border-none text-sm text-white focus:ring-0 focus:outline-none w-48 placeholder-gray-500">
            </div>
        </nav>

        {{-- B. AREA BAWAH (Sidebar + Main Content) --}}
        {{-- flex-1 artinya mengisi sisa ruang di bawah header --}}
        <div class="flex flex-1 overflow-hidden">
            
            {{-- 1. SIDEBAR (Dynamic Include) --}}
            @auth
                @if(Auth::user()->role == 'admin')
                    @include('layouts.sidebar.admin')
                
                @elseif(Auth::user()->role == 'club' || Auth::user()->role == 'klub')
                    @include('layouts.sidebar.club')

                @elseif(Auth::user()->role == 'sekolah')
                    @include('layouts.sidebar.sekolah')
                    
                @elseif(Auth::user()->role == 'superadmin')
                    @include('layouts.sidebar.superadmin')
                
                @else
                    {{-- Default fallback --}}
                    @include('layouts.sidebar.club') 
                @endif
            @else
                {{-- Development fallback --}}
                @include('layouts.sidebar.club')
            @endauth

            {{-- 2. CONTENT AREA (Scrollable) --}}
            <div class="flex-1 flex flex-col overflow-hidden relative bg-[#F9FAFB]">
                {{-- Konten halaman akan masuk ke sini --}}
                {{-- Tambahkan overflow-y-auto agar bisa discroll --}}
                <div class="flex-1 overflow-y-auto custom-scrollbar">
                    @yield('content')
                </div>
            </div>

        </div>
    </div>

</body>
</html>
@php
    // CLUB YANG LOGIN - Gunakan guard spesifik agar data akurat
    $club = auth()->guard('club')->user();
    $displayName = $club?->name ?? 'Club'; // Sesuaikan dengan kolom 'name' di database
@endphp

<aside class="w-72 bg-white border-r border-gray-100 flex-shrink-0 flex flex-col transition-all duration-300 shadow-[4px_0_24px_rgba(0,0,0,0.02)] z-20">
    
    {{-- PROFILE CLUB --}}
    <div class="px-6 py-6">
        <div class="p-4 bg-gradient-to-r from-gray-50 to-white border border-gray-100 rounded-2xl flex items-center gap-4 shadow-sm">
            <div class="relative">
                <img 
                    src="https://ui-avatars.com/api/?name={{ urlencode($displayName) }}&background=D92323&color=fff&bold=true"
                    alt="Club"
                    class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-md"
                >
                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
            </div>
            <div>
                <h3 class="font-bold text-gray-800 text-sm truncate w-32">
                    {{ $displayName }}
                </h3>
                <p class="text-xs text-gray-500">
                    Admin Klub
                </p>
            </div>
        </div>
    </div>

    {{-- MENU --}}
    <nav class="flex-1 overflow-y-auto px-4 space-y-1.5 custom-scrollbar">

        <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-2 mb-2">
            Utama
        </p>

        {{-- DASHBOARD --}}
        <a href="{{ route('club.dashboard') }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('club.dashboard') 
                ? 'bg-red-50 text-red-700 font-semibold shadow-sm ring-1 ring-red-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-th-large w-6 text-center 
            {{ request()->routeIs('club.dashboard') ? 'text-red-600' : 'text-gray-400 group-hover:text-red-500' }}"></i>
            Dashboard
        </a>

        {{-- PROFIL KLUB --}}
        <a href="{{ route('club.profile') }}" 
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('club.profile') 
                ? 'bg-red-50 text-red-700 font-semibold shadow-sm ring-1 ring-red-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-user-circle w-6 text-center 
            {{ request()->routeIs('club.profile') ? 'text-red-600' : 'text-gray-400 group-hover:text-red-500' }}"></i>
            Profil Klub
        </a>

        <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">
            Manajemen Data
        </p>

        {{-- DATA ATLET --}}
        {{-- Menggunakan athlete.index (singular) sesuai Resource di web.php --}}
        <a href="{{ route('athlete.index') }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('athlete.*') 
                ? 'bg-red-50 text-red-700 font-semibold shadow-sm ring-1 ring-red-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-swimmer w-6 text-center 
            {{ request()->routeIs('athlete.*') ? 'text-red-600' : 'text-gray-400 group-hover:text-red-500' }}"></i>
            Data Atlet
        </a>

        {{-- KATEGORI RENANG --}}
        <a href="{{ route('club.category.index') }}" 
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('club.category.*') 
                ? 'bg-red-50 text-red-700 font-semibold shadow-sm ring-1 ring-red-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-tags w-6 text-center 
            {{ request()->routeIs('club.category.*') ? 'text-red-600' : 'text-gray-400 group-hover:text-red-500' }}"></i>
            Daftar Kategori
        </a>

        <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">
            Aktivitas
        </p>

        {{-- MANAJEMEN EVENT --}}
        {{-- UPDATED: Menggunakan 'event.index' (Read Only untuk Club) --}}
        <a href="{{ route('event.index') }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('event.*') 
                ? 'bg-red-50 text-red-700 font-semibold shadow-sm ring-1 ring-red-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-calendar-alt w-6 text-center 
            {{ request()->routeIs('event.*') ? 'text-red-600' : 'text-gray-400 group-hover:text-red-500' }}"></i>
            Daftar Event
        </a>

        {{-- LOGOUT --}}
        <div class="mt-8 pt-4 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center px-4 py-3 text-sm font-medium text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition-colors">
                    <i class="fas fa-sign-out-alt w-6 text-center"></i>
                    Logout
                </button>
            </form>
        </div>

    </nav>
</aside>
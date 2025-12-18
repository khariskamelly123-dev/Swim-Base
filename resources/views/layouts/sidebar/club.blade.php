@php
    // CLUB YANG LOGIN
    $club = auth()->user();
    $displayName = $club?->nama_klub ?? 'Club';
@endphp

<aside class="w-72 bg-white border-r border-gray-100 flex-shrink-0 flex flex-col transition-all duration-300 shadow-[4px_0_24px_rgba(0,0,0,0.02)] z-20">
    
    {{-- PROFILE CLUB --}}
    <div class="px-6 py-6">
        <div class="p-4 bg-gradient-to-r from-gray-50 to-white border border-gray-100 rounded-2xl flex items-center gap-4 shadow-sm">
            <div class="relative">
                <img 
                    src="https://ui-avatars.com/api/?name={{ urlencode($displayName) }}&background=FEE2E2&color=DC2626&bold=true"
                    alt="Club"
                    class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-md"
                >
                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
            </div>
            <div>
                <h3 class="font-bold text-gray-800 text-sm">
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
        <a href="{{ route('dashboard_klub') }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('dashboard_klub') 
                ? 'bg-red-50 text-red-700 font-semibold shadow-sm ring-1 ring-red-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-th-large w-6 text-center 
            {{ request()->routeIs('dashboard_klub') ? 'text-red-600' : 'text-gray-400 group-hover:text-red-500' }}"></i>
            Dashboard
        </a>

        {{-- PROFIL KLUB --}}
        {{-- Pastikan nama route di web.php adalah 'profil.index' --}}
        <a href="{{ route('profil.index') }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('profil.index') 
                ? 'bg-red-50 text-red-700 font-semibold shadow-sm ring-1 ring-red-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-user-circle w-6 text-center 
            {{ request()->routeIs('profil.index') ? 'text-red-600' : 'text-gray-400 group-hover:text-red-500' }}"></i>
            Profil Klub
        </a>

        <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">
            Manajemen Data
        </p>

        {{-- DATA ATLET --}}
        <a href="{{ route('atlet.index') }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('atlet*') 
                ? 'bg-red-50 text-red-700 font-semibold shadow-sm ring-1 ring-red-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-swimmer w-6 text-center 
            {{ request()->routeIs('atlet*') ? 'text-red-600' : 'text-gray-400 group-hover:text-red-500' }}"></i>
            Data Atlet
        </a>

        {{-- KATEGORI RENANG --}}
        {{-- Ganti 'kategori.index' dengan nama route aslimu --}}
        <a href="{{ route('kategori.index') ?? '#' }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('kategori.*') 
                ? 'bg-red-50 text-red-700 font-semibold shadow-sm ring-1 ring-red-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-layer-group w-6 text-center 
            {{ request()->routeIs('kategori.*') ? 'text-red-600' : 'text-gray-400 group-hover:text-red-500' }}"></i>
            Kategori Renang
        </a>

        <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">
            Aktivitas
        </p>

        {{-- MANAJEMEN EVENT --}}
        {{-- Ganti 'event.index' dengan nama route aslimu --}}
        <a href="{{ route('event.index') ?? '#' }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('event.*') 
                ? 'bg-red-50 text-red-700 font-semibold shadow-sm ring-1 ring-red-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-calendar-alt w-6 text-center 
            {{ request()->routeIs('event.*') ? 'text-red-600' : 'text-gray-400 group-hover:text-red-500' }}"></i>
            Manajemen Event
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
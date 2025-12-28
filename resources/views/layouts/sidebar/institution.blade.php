@php
    // INSTITUTION YANG LOGIN
    $institution = auth()->guard('institution')->user();
    $displayName = $institution?->name ?? 'Institusi';
@endphp

<aside class="w-72 bg-white border-r border-gray-100 flex-shrink-0 flex flex-col transition-all duration-300 shadow-[4px_0_24px_rgba(0,0,0,0.02)] z-20">
    
    {{-- PROFILE INSTITUTION --}}
    <div class="px-6 py-6">
        <div class="p-4 bg-gradient-to-r from-emerald-50 to-white border border-emerald-100 rounded-2xl flex items-center gap-4 shadow-sm">
            <div class="relative">
                <img 
                    src="https://ui-avatars.com/api/?name={{ urlencode($displayName) }}&background=10b981&color=fff&bold=true"
                    alt="Institution"
                    class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-md"
                >
                <div class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-500 border-2 border-white rounded-full"></div>
            </div>
            <div>
                <h3 class="font-bold text-gray-800 text-sm truncate w-32">
                    {{ $displayName }}
                </h3>
                <p class="text-[10px] text-emerald-600 font-bold uppercase tracking-tight">
                    Portal Akademik
                </p>
            </div>
        </div>
    </div>

    {{-- MENU --}}
    <nav class="flex-1 overflow-y-auto px-4 space-y-1.5 custom-scrollbar">

        <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-2 mb-2">
            Ringkasan
        </p>

        {{-- DASHBOARD --}}
        <a href="{{ route('institution.dashboard') }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('institution.dashboard') 
                ? 'bg-emerald-50 text-emerald-700 font-semibold shadow-sm ring-1 ring-emerald-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-chart-pie w-6 text-center 
            {{ request()->routeIs('institution.dashboard') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-emerald-500' }}"></i>
            Dashboard
        </a>

        {{-- PROFIL INSTITUSI --}}
        <a href="{{ Route::has('institution.profile') ? route('institution.profile') : '#' }}" 
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('institution.profile') 
                ? 'bg-emerald-50 text-emerald-700 font-semibold shadow-sm ring-1 ring-emerald-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-university w-6 text-center 
            {{ request()->routeIs('institution.profile') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-emerald-500' }}"></i>
            Profil Instansi
        </a>

        <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">
            Kesiswaan & Atlet
        </p>

        {{-- DATA ATLET PER SEKOLAH --}}
        <a href="{{ Route::has('institution.athlete.index') ? route('institution.athlete.index') : '#' }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('institution.athlete.*') 
                ? 'bg-emerald-50 text-emerald-700 font-semibold shadow-sm ring-1 ring-emerald-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-user-graduate w-6 text-center 
            {{ request()->routeIs('institution.athlete.*') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-emerald-500' }}"></i>
            Daftar Atlet
        </a>

        {{-- CAPAIAN PRESTASI --}}
        <a href="{{ Route::has('institution.achievement.index') ? route('institution.achievement.index') : '#' }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('institution.achievement.*') 
                ? 'bg-emerald-50 text-emerald-700 font-semibold shadow-sm ring-1 ring-emerald-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-award w-6 text-center 
            {{ request()->routeIs('institution.achievement.*') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-emerald-500' }}"></i>
            Rekap Prestasi
        </a>

        <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">
            Informasi
        </p>

        {{-- DAFTAR EVENT (READ ONLY) --}}
        <a href="{{ route('event.index') }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('event.*') 
                ? 'bg-emerald-50 text-emerald-700 font-semibold shadow-sm ring-1 ring-emerald-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-calendar-alt w-6 text-center 
            {{ request()->routeIs('event.*') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-emerald-500' }}"></i>
            Jadwal Event
        </a>

        {{-- LOGOUT --}}
        <div class="mt-8 pt-4 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center px-4 py-3 text-sm font-medium text-gray-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-colors">
                    <i class="fas fa-sign-out-alt w-6 text-center"></i>
                    Logout Portal
                </button>
            </form>
        </div>

    </nav>
</aside>
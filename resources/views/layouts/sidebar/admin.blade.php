@php
    // ADMIN (OPERATOR) YANG LOGIN
    $admin = auth()->guard('admin')->user();
    $displayName = $admin?->name ?? 'Admin Event';
@endphp

<aside class="w-72 bg-white border-r border-gray-100 flex-shrink-0 flex flex-col transition-all duration-300 shadow-[4px_0_24px_rgba(0,0,0,0.02)] z-20">
    
    {{-- PROFILE ADMIN --}}
    <div class="px-6 py-6">
        <div class="p-4 bg-gradient-to-r from-indigo-600 to-indigo-700 border border-indigo-500 rounded-2xl flex items-center gap-4 shadow-lg">
            <div class="relative">
                <img 
                    src="https://ui-avatars.com/api/?name={{ urlencode($displayName) }}&background=ffffff&color=4f46e5&bold=true"
                    alt="Admin"
                    class="w-12 h-12 rounded-full object-cover border-2 border-indigo-400 shadow-md"
                >
                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-white rounded-full"></div>
            </div>
            <div>
                <h3 class="font-bold text-white text-sm truncate w-32">
                    {{ $displayName }}
                </h3>
                <p class="text-[10px] text-indigo-100 uppercase font-bold tracking-wider">
                    Event Operator
                </p>
            </div>
        </div>
    </div>

    {{-- MENU --}}
    <nav class="flex-1 overflow-y-auto px-4 space-y-1.5 custom-scrollbar">

        <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-2 mb-2">
            Workspace
        </p>

        {{-- DASHBOARD --}}
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('admin.dashboard') 
                ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm ring-1 ring-indigo-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-desktop w-6 text-center 
            {{ request()->routeIs('admin.dashboard') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-500' }}"></i>
            Dashboard Admin
        </a>

        <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">
            Manajemen Lomba
        </p>

        {{-- KELOLA EVENT --}}
        <a href="{{ Route::has('admin.event.index') ? route('admin.event.index') : '#' }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('admin.event.*') 
                ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm ring-1 ring-indigo-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-calendar-check w-6 text-center 
            {{ request()->routeIs('admin.event.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-500' }}"></i>
            Kelola Kompetisi
        </a>

        {{-- INPUT HASIL / MEET RANK --}}
        <a href="{{ route('admin.results.index') }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('admin.results.*') 
                ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm ring-1 ring-indigo-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-stopwatch w-6 text-center 
            {{ request()->routeIs('admin.results.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-500' }}"></i>
            Input Hasil Lomba
        </a>

        <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">
            Data & Laporan
        </p>

        {{-- VERIFIKASI PESERTA --}}
        <a href="{{ Route::has('admin.verification.index') ? route('admin.verification.index') : '#' }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('admin.verification.*') 
                ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm ring-1 ring-indigo-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-user-check w-6 text-center 
            {{ request()->routeIs('admin.verification.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-500' }}"></i>
            Verifikasi Peserta
        </a>

        {{-- CETAK SERTIFIKAT --}}
        <a href="{{ Route::has('admin.certificates.index') ? route('admin.certificates.index') : '#' }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('admin.certificates.*') 
                ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm ring-1 ring-indigo-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-print w-6 text-center 
            {{ request()->routeIs('admin.certificates.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-500' }}"></i>
            Cetak Sertifikat
        </a>

        {{-- LOGOUT --}}
        <div class="mt-8 pt-4 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center px-4 py-3 text-sm font-medium text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors">
                    <i class="fas fa-sign-out-alt w-6 text-center"></i>
                    Keluar
                </button>
            </form>
        </div>

    </nav>
</aside>
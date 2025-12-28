@php
    // SUPER ADMIN YANG LOGIN
    $user = auth()->guard('super_admin')->user();
    $displayName = $user?->name ?? 'Super Admin';
@endphp

<aside class="w-72 bg-white border-r border-gray-100 flex-shrink-0 flex flex-col transition-all duration-300 shadow-[4px_0_24px_rgba(0,0,0,0.02)] z-20">
    
    {{-- PROFILE SUPER ADMIN --}}
    <div class="px-6 py-6">
        <div class="p-4 bg-gradient-to-r from-slate-800 to-slate-900 border border-slate-700 rounded-2xl flex items-center gap-4 shadow-lg">
            <div class="relative">
                <img 
                    src="https://ui-avatars.com/api/?name={{ urlencode($displayName) }}&background=0f172a&color=fff&bold=true"
                    alt="Super Admin"
                    class="w-12 h-12 rounded-full object-cover border-2 border-slate-600 shadow-md"
                >
                <div class="absolute bottom-0 right-0 w-3 h-3 bg-blue-500 border-2 border-white rounded-full"></div>
            </div>
            <div>
                <h3 class="font-bold text-white text-sm truncate w-32">
                    {{ $displayName }}
                </h3>
                <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">
                    Root Access
                </p>
            </div>
        </div>
    </div>

    {{-- MENU --}}
    <nav class="flex-1 overflow-y-auto px-4 space-y-1.5 custom-scrollbar">

        <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-2 mb-2">
            Main Console
        </p>

        {{-- DASHBOARD --}}
        <a href="{{ route('super.dashboard') }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('super.dashboard') 
                ? 'bg-blue-50 text-blue-700 font-semibold shadow-sm ring-1 ring-blue-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-chart-line w-6 text-center 
            {{ request()->routeIs('super.dashboard') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-500' }}"></i>
            System Overview
        </a>

        <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">
            User Management
        </p>

        {{-- MANAJEMEN SEMUA USER --}}
        <a href="{{ route('super.users.index') }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('super.users.*') 
                ? 'bg-blue-50 text-blue-700 font-semibold shadow-sm ring-1 ring-blue-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-users-cog w-6 text-center 
            {{ request()->routeIs('super.users.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-500' }}"></i>
            Kelola Pengguna
        </a>

        <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">
            Pusat Validasi
        </p>

        {{-- APPROVAL CENTER --}}
        <a href="{{ route('super.approval.index') }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('super.approval.*') 
                ? 'bg-amber-50 text-amber-700 font-semibold shadow-sm ring-1 ring-amber-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-clipboard-check w-6 text-center 
            {{ request()->routeIs('super.approval.*') ? 'text-amber-600' : 'text-gray-400 group-hover:text-amber-500' }}"></i>
            Persetujuan Data
            @php
                $pendingCount = \App\Models\Submission::where('status', 'pending')->count();
            @endphp
            @if($pendingCount > 0)
                <span class="ml-auto bg-amber-500 text-white text-[10px] px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
            @endif
        </a>

        <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">
            Database Master
        </p>

        {{-- KATEGORI (Global) --}}
        {{-- Gunakan '#' jika route belum Anda buat di web.php untuk menghindari error --}}
        <a href="{{ Route::has('category.index') ? route('category.index') : '#' }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('category.*') 
                ? 'bg-blue-50 text-blue-700 font-semibold shadow-sm ring-1 ring-blue-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-tags w-6 text-center 
            {{ request()->routeIs('category.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-500' }}"></i>
            Master Kategori
        </a>

        {{-- SEMUA DATA ATLET --}}
        {{-- Pastikan nama route di web.php adalah 'athletes.index' atau ganti ke '#' --}}
        <a href="{{ Route::has('athletes.index') ? route('athletes.index') : '#' }}"
           class="flex items-center px-4 py-3 text-sm rounded-xl group transition-all 
           {{ request()->routeIs('athletes.*') 
                ? 'bg-blue-50 text-blue-700 font-semibold shadow-sm ring-1 ring-blue-100' 
                : 'font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-swimmer w-6 text-center 
            {{ request()->routeIs('athletes.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-500' }}"></i>
            Database Atlet
        </a>

        {{-- LOGOUT --}}
        <div class="mt-8 pt-4 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center px-4 py-3 text-sm font-medium text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition-colors">
                    <i class="fas fa-sign-out-alt w-6 text-center"></i>
                    Logout System
                </button>
            </form>
        </div>

    </nav>
</aside>
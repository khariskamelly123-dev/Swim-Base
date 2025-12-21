@php
    $user = auth()->user();
    // Asumsi nama kolom role di database adalah 'role'
    // Value role: 'super_admin', 'admin', 'klub', 'sekolah'
    $role = $user->role ?? 'klub'; 
    
    // Logika Tampilan Profil & Badge
    if ($role === 'super_admin') {
        $displayName = 'Super Administrator';
        $badgeText = 'Master Control';
        $badgeColor = 'bg-purple-500';
        $gradient = 'from-purple-50 to-white';
        $themeColor = 'purple'; // Untuk hover/active state
    } elseif ($role === 'admin') {
        $displayName = $user->name ?? 'Admin Lomba';
        $badgeText = 'Operator';
        $badgeColor = 'bg-blue-500';
        $gradient = 'from-blue-50 to-white';
        $themeColor = 'blue';
    } else {
        // Untuk Klub & Sekolah
        $displayName = $user->nama_klub ?? $user->nama_sekolah ?? 'User Instansi';
        $badgeText = ($role === 'sekolah') ? 'Admin Sekolah' : 'Admin Klub';
        $badgeColor = 'bg-red-500'; // Tetap merah sesuai request
        $gradient = 'from-red-50 to-white'; // Menggunakan red-50 bukan gray-50 agar senada
        $themeColor = 'red';
    }
@endphp

<aside class="w-72 bg-white border-r border-gray-100 flex-shrink-0 flex flex-col transition-all duration-300 shadow-[4px_0_24px_rgba(0,0,0,0.02)] z-20">
    
    {{-- PROFILE SECTION (DINAMIS) --}}
    <div class="px-6 py-6">
        <div class="p-4 bg-gradient-to-r {{ $gradient }} border border-gray-100 rounded-2xl flex items-center gap-4 shadow-sm">
            <div class="relative">
                <img 
                    src="https://ui-avatars.com/api/?name={{ urlencode($displayName) }}&background=random&color=fff&bold=true"
                    alt="Profile"
                    class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-md"
                >
                {{-- Status Dot --}}
                <div class="absolute bottom-0 right-0 w-3 h-3 {{ $badgeColor }} border-2 border-white rounded-full"></div>
            </div>
            <div class="overflow-hidden">
                <h3 class="font-bold text-gray-800 text-sm truncate w-32" title="{{ $displayName }}">
                    {{ $displayName }}
                </h3>
                <p class="text-[10px] uppercase font-semibold tracking-wider text-gray-500">
                    {{ $badgeText }}
                </p>
            </div>
        </div>
    </div>

    {{-- MENU NAVIGATION --}}
    <nav class="flex-1 overflow-y-auto px-4 space-y-1.5 custom-scrollbar">

        {{-- ===============================================================
             1. MENU SUPER ADMIN
             =============================================================== --}}
        @if($role === 'super_admin')
            
            <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-2 mb-2">Utama</p>
            <a href="{{ route('super.dashboard') }}" class="nav-item {{ request()->routeIs('super.dashboard') ? 'active-purple' : '' }}">
                <i class="fas fa-chart-pie w-6 text-center"></i> Dashboard
            </a>

            <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">Master Data</p>
            <a href="{{ route('super.users.index') }}" class="nav-item {{ request()->routeIs('super.users*') ? 'active-purple' : '' }}">
                <i class="fas fa-users-cog w-6 text-center"></i> Data User
            </a>

            <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">Pusat Validasi</p>
            <a href="{{ route('super.approval.edit') }}" class="nav-item {{ request()->routeIs('super.approval.edit') ? 'active-purple' : '' }}">
                <i class="fas fa-edit w-6 text-center"></i> Pengajuan Edit
                {{-- Badge Notifikasi jika ada --}}
                <span class="ml-auto bg-purple-100 text-purple-600 py-0.5 px-2 rounded-md text-xs font-bold">2</span>
            </a>
            <a href="{{ route('super.approval.hapus') }}" class="nav-item {{ request()->routeIs('super.approval.hapus') ? 'active-purple' : '' }}">
                <i class="fas fa-trash-restore w-6 text-center"></i> Pengajuan Hapus
            </a>

        {{-- ===============================================================
             2. MENU ADMIN (OPERATOR LOMBA)
             =============================================================== --}}
        @elseif($role === 'admin')
            
            <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-2 mb-2">Utama</p>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active-blue' : '' }}">
                <i class="fas fa-home w-6 text-center"></i> Dashboard
            </a>

            <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">Kompetisi</p>
            <a href="{{ route('admin.event.list') }}" class="nav-item {{ request()->routeIs('admin.event*') ? 'active-blue' : '' }}">
                <i class="fas fa-calendar-check w-6 text-center"></i> List Event
            </a>

            <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">Pencatatan Rekor</p>
            <a href="{{ route('admin.input.fp') }}" class="nav-item {{ request()->routeIs('admin.input.fp') ? 'active-blue' : '' }}">
                <i class="fas fa-stopwatch w-6 text-center"></i> Input Hasil FP
            </a>
            <a href="{{ route('admin.rekor.verifikasi') }}" class="nav-item {{ request()->routeIs('admin.rekor*') ? 'active-blue' : '' }}">
                <i class="fas fa-clipboard-check w-6 text-center"></i> Verifikasi Rekor
            </a>

        {{-- ===============================================================
             3. MENU USER (KLUB & SEKOLAH) - SAMA PERSIS
             =============================================================== --}}
        @else 
            {{-- Logic: role 'klub' atau 'sekolah' --}}
            
            <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-2 mb-2">Utama</p>
            
            <a href="{{ route('dashboard_klub') }}" class="nav-item {{ request()->routeIs('dashboard_klub') ? 'active-red' : '' }}">
                <i class="fas fa-th-large w-6 text-center"></i> Dashboard
            </a>

            <a href="{{ route('profil.index') }}" class="nav-item {{ request()->routeIs('profil.index') ? 'active-red' : '' }}">
                <i class="fas fa-user-circle w-6 text-center"></i> Profil Instansi
            </a>

            <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">Manajemen Data</p>
            
            <a href="{{ route('atlet.index') }}" class="nav-item {{ request()->routeIs('atlet*') ? 'active-red' : '' }}">
                <i class="fas fa-swimmer w-6 text-center"></i> Data Atlet
            </a>
            
            {{-- Menu Pengajuan (Untuk melihat status edit/hapus) --}}
            <a href="{{ route('pengajuan.status') }}" class="nav-item {{ request()->routeIs('pengajuan*') ? 'active-red' : '' }}">
                <i class="fas fa-file-contract w-6 text-center"></i> Status Pengajuan
            </a>

            <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">Aktivitas</p>
            
            <a href="{{ route('event.index') }}" class="nav-item {{ request()->routeIs('event.*') ? 'active-red' : '' }}">
                <i class="fas fa-calendar-alt w-6 text-center"></i> Manajemen Event
            </a>
        @endif

        {{-- LOGOUT (UMUM UNTUK SEMUA) --}}
        <div class="mt-8 pt-4 border-t border-gray-100 pb-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 text-sm font-medium text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition-colors">
                    <i class="fas fa-sign-out-alt w-6 text-center"></i> Logout
                </button>
            </form>
        </div>

    </nav>
</aside>

{{-- 
    STYLE TAMBAHAN (Letakkan di tag <style> head atau di file CSS Anda)
    Ini untuk menyingkat class Tailwind yang panjang di HTML di atas.
--}}
<style>
    /* Base Nav Item */
    .nav-item {
        @apply flex items-center px-4 py-3 text-sm rounded-xl transition-all font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 cursor-pointer;
    }
    
    /* Active State Merah (Klub/Sekolah) */
    .nav-item.active-red {
        @apply bg-red-50 text-red-700 font-semibold shadow-sm ring-1 ring-red-100;
    }
    .nav-item.active-red i {
        @apply text-red-600;
    }

    /* Active State Ungu (Super Admin) */
    .nav-item.active-purple {
        @apply bg-purple-50 text-purple-700 font-semibold shadow-sm ring-1 ring-purple-100;
    }
    .nav-item.active-purple i {
        @apply text-purple-600;
    }

    /* Active State Biru (Admin) */
    .nav-item.active-blue {
        @apply bg-blue-50 text-blue-700 font-semibold shadow-sm ring-1 ring-blue-100;
    }
    .nav-item.active-blue i {
        @apply text-blue-600;
    }
</style>
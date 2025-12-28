@php
    // Default variable
    $role = 'guest';
    $displayName = 'User';
    $user = null;
    $guardName = 'web'; // Default guard

    // 1. CEK SUPER ADMIN
    if (auth()->guard('superadmin')->check()) {
        $user = auth()->guard('superadmin')->user();
        $role = 'superadmin';
        $displayName = $user->name ?? 'Super Administrator';
        $guardName = 'superadmin';
        
        // Style: Purple
        $badgeText = 'Master Control';
        $badgeColor = 'bg-purple-500';
        $gradient = 'from-purple-50 to-white';
        
    // 2. CEK ADMIN (EVENT ORGANIZER)
    } elseif (auth()->guard('admin')->check()) {
        $user = auth()->guard('admin')->user();
        $role = 'admin';
        $displayName = $user->name ?? 'Admin Lomba';
        $guardName = 'admin';
        
        // Style: Blue
        $badgeText = 'Event Organizer';
        $badgeColor = 'bg-blue-500';
        $gradient = 'from-blue-50 to-white';

    // 3. CEK CLUB
    } elseif (auth()->guard('club')->check()) {
        $user = auth()->guard('club')->user();
        $role = 'club';
        $displayName = $user->name ?? 'Club Member'; 
        $guardName = 'club';
        
        // Style: Red
        $badgeText = 'Admin Klub';
        $badgeColor = 'bg-red-500';
        $gradient = 'from-red-50 to-white';

    // 4. CEK INSTITUTION (SEKOLAH/KAMPUS)
    // Pastikan di config/auth.php guard-nya bernama 'institution'
    } elseif (auth()->guard('institution')->check()) {
        $user = auth()->guard('institution')->user();
        $role = 'institution';
        $displayName = $user->name ?? 'Institution Rep';
        $guardName = 'institution';
        
        // Style: Orange
        $badgeText = 'Admin Sekolah/Univ';
        $badgeColor = 'bg-orange-500'; 
        $gradient = 'from-orange-50 to-white';
    }
@endphp

<aside class="w-72 bg-white border-r border-gray-100 flex-shrink-0 flex flex-col transition-all duration-300 shadow-[4px_0_24px_rgba(0,0,0,0.02)] z-20 h-screen sticky top-0">
    
    {{-- PROFILE SECTION --}}
    <div class="px-6 py-6">
        <div class="p-4 bg-gradient-to-r {{ $gradient }} border border-gray-100 rounded-2xl flex items-center gap-4 shadow-sm group hover:shadow-md transition-all cursor-default">
            <div class="relative">
                <img 
                    src="https://ui-avatars.com/api/?name={{ urlencode($displayName) }}&background=random&color=fff&bold=true"
                    alt="Profile"
                    class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-md group-hover:scale-105 transition-transform"
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
    <nav class="flex-1 overflow-y-auto px-4 space-y-1.5 custom-scrollbar pb-10">

        {{-- ===============================================================
             1. MENU SUPER ADMIN
             =============================================================== --}}
        @if($role === 'superadmin')
            
            <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-2 mb-2">Dashboard</p>
            <a href="{{ route('superadmin.dashboard') }}" class="nav-item {{ request()->routeIs('super.dashboard') ? 'active-purple' : '' }}">
                <i class="fas fa-chart-pie w-6 text-center"></i> Overview
            </a>

            <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">Master Data</p>
            <a href="{{ route('super.admins.index') }}" class="nav-item {{ request()->routeIs('super.admins*') ? 'active-purple' : '' }}">
                <i class="fas fa-user-shield w-6 text-center"></i> Data Admin
            </a>
            <a href="{{ route('super.clubs.index') }}" class="nav-item {{ request()->routeIs('super.clubs*') ? 'active-purple' : '' }}">
                <i class="fas fa-swimmer w-6 text-center"></i> Data Clubs
            </a>
            <a href="{{ route('super.institutions.index') }}" class="nav-item {{ request()->routeIs('super.institutions*') ? 'active-purple' : '' }}">
                <i class="fas fa-school w-6 text-center"></i> Data Institutions
            </a>

        {{-- ===============================================================
             2. MENU ADMIN (OPERATOR LOMBA)
             =============================================================== --}}
        @elseif($role === 'admin')
            
            <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-2 mb-2">Main</p>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active-blue' : '' }}">
                <i class="fas fa-home w-6 text-center"></i> Dashboard
            </a>

            <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">Event Management</p>
            <a href="{{ route('events.index') }}" class="nav-item {{ request()->routeIs('events.*') ? 'active-blue' : '' }}">
                <i class="fas fa-calendar-check w-6 text-center"></i> Events List
            </a>
            {{-- Menu Baru berdasarkan AchievementSeeder --}}
            <a href="{{ route('achievements.index') }}" class="nav-item {{ request()->routeIs('achievements.*') ? 'active-blue' : '' }}">
                <i class="fas fa-medal w-6 text-center"></i> Result & Records
            </a>

        {{-- ===============================================================
             3. MENU CLUB & INSTITUTION (PARTICIPANTS)
             =============================================================== --}}
        @elseif($role === 'club' || $role === 'institution')
            
            {{-- Tentukan warna active berdasarkan role --}}
            @php $activeClass = ($role === 'club') ? 'active-red' : 'active-orange'; @endphp
            
            <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-2 mb-2">Main</p>
            
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? $activeClass : '' }}">
                <i class="fas fa-th-large w-6 text-center"></i> Dashboard
            </a>

            <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">Team Management</p>
            
            {{-- Menu Athletes (Sesuai Import CSV tadi) --}}
            <a href="{{ route('athletes.index') }}" class="nav-item {{ request()->routeIs('athletes*') ? $activeClass : '' }}">
                <i class="fas fa-users w-6 text-center"></i> My Athletes
            </a>
            
            {{-- Menu Events (Pendaftaran) --}}
            <a href="{{ route('events.list') }}" class="nav-item {{ request()->routeIs('events.list') ? $activeClass : '' }}">
                <i class="fas fa-calendar-alt w-6 text-center"></i> Join Events
            </a>

            {{-- Histori Prestasi --}}
            <a href="{{ route('achievements.my') }}" class="nav-item {{ request()->routeIs('achievements.my') ? $activeClass : '' }}">
                <i class="fas fa-trophy w-6 text-center"></i> Achievements
            </a>

        @endif

        {{-- ===============================================================
             LOGOUT (GLOBAL)
             =============================================================== --}}
        <div class="mt-8 pt-4 border-t border-gray-100 pb-6 px-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                {{-- Kirim input hidden agar controller tahu siapa yang logout (opsional tergantung controller) --}}
                <input type="hidden" name="guard" value="{{ $guardName }}">
                
                <button type="submit" class="w-full flex items-center px-4 py-3 text-sm font-medium text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition-colors group">
                    <i class="fas fa-sign-out-alt w-6 text-center group-hover:scale-110 transition-transform"></i> 
                    <span class="ml-3">Logout</span>
                </button>
            </form>
        </div>

    </nav>
</aside>

{{-- 
    CSS STYLE (Letakkan di file app.css atau <style> head)
--}}
<style>
    /* Base Nav Item */
    .nav-item {
        @apply flex items-center px-4 py-3 text-sm rounded-xl transition-all font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 cursor-pointer mb-1;
    }
    
    /* Club Active (Red) */
    .nav-item.active-red {
        @apply bg-red-50 text-red-700 font-semibold shadow-sm ring-1 ring-red-100;
    }
    .nav-item.active-red i { @apply text-red-600; }

    /* Institution Active (Orange) */
    .nav-item.active-orange {
        @apply bg-orange-50 text-orange-700 font-semibold shadow-sm ring-1 ring-orange-100;
    }
    .nav-item.active-orange i { @apply text-orange-600; }

    /* Super Admin Active (Purple) */
    .nav-item.active-purple {
        @apply bg-purple-50 text-purple-700 font-semibold shadow-sm ring-1 ring-purple-100;
    }
    .nav-item.active-purple i { @apply text-purple-600; }

    /* Admin Active (Blue) */
    .nav-item.active-blue {
        @apply bg-blue-50 text-blue-700 font-semibold shadow-sm ring-1 ring-blue-100;
    }
    .nav-item.active-blue i { @apply text-blue-600; }

    /* Custom Scrollbar for Sidebar */
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #f1f1f1; border-radius: 20px; }
    .custom-scrollbar:hover::-webkit-scrollbar-thumb { background-color: #d1d5db; }
</style>
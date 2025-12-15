@php
    // CLUB YANG LOGIN
    $club = auth()->user();
    $displayName = $club?->nama_klub ?? 'Club';
@endphp

<aside class="w-72 bg-white border-r border-gray-100 flex-shrink-0 flex flex-col transition-all duration-300 shadow-[4px_0_24px_rgba(0,0,0,0.02)] z-20">
    
    {{-- HEADER --}}
    <div class="h-20 flex items-center px-8 border-b border-gray-50">
        <div class="w-10 h-10 bg-gradient-to-br from-red-600 to-red-500 rounded-xl flex items-center justify-center text-white font-bold text-sm mr-3 shadow-red-200 shadow-lg">
            <i class="fas fa-swimmer"></i>
        </div>
        <div>
            <span class="text-xl font-bold text-gray-900 tracking-tight block leading-none">
                Swim<span class="text-red-600">Base</span>
            </span>
            <span class="text-[10px] text-gray-400 font-medium tracking-wider uppercase">
                Club Dashboard
            </span>
        </div>
    </div>

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

        <a href="{{ route('dashboard_klub') }}"
           class="flex items-center px-4 py-3 text-sm font-semibold bg-red-50 text-red-700 rounded-xl group transition-all shadow-sm ring-1 ring-red-100">
            <i class="fas fa-th-large w-6 text-center text-red-600"></i>
            Dashboard
        </a>

        <a href="profil.index"
           class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl transition-colors">
            <i class="fas fa-user-circle w-6 text-center text-gray-400 group-hover:text-red-500"></i>
            Profil Klub
        </a>

        <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">
            Manajemen Data
        </p>

        <a href="data.klub"
           class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl transition-colors">
            <i class="fas fa-swimmer w-6 text-center text-gray-400 group-hover:text-red-500"></i>
            Data Atlet
        </a>

        <a href="#"
           class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl transition-colors">
            <i class="fas fa-layer-group w-6 text-center text-gray-400 group-hover:text-red-500"></i>
            Kategori Renang
        </a>

        <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">
            Aktivitas
        </p>

        <a href=""
           class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl transition-colors">
            <i class="fas fa-calendar-alt w-6 text-center text-gray-400 group-hover:text-red-500"></i>
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

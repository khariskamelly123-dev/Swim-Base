@extends('layouts.dashboard')

@section('title', 'System Console - Super Admin')

@section('styles')
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .bg-slate-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        }
    </style>
@endsection

@section('content')
    {{-- Header --}}
    <header class="glass-effect border-b border-gray-200/60 h-20 flex items-center justify-between px-8 sticky top-0 z-30">
        <div>
            <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">System Console</h2>
            <p class="text-[10px] font-bold text-blue-600 mt-0.5 tracking-widest uppercase">Root Administrator Access</p>
        </div>

        <div class="flex items-center gap-6">
            {{-- Notification Badge untuk Approval --}}
            @php $pendingCount = \App\Models\Submission::where('status', 'pending')->count(); @endphp
            <a href="{{ route('super.approval.index') }}" class="relative p-2 text-slate-400 hover:text-blue-600 transition-colors">
                <i class="fas fa-bell text-lg"></i>
                @if($pendingCount > 0)
                    <span class="absolute top-0 right-0 h-4 w-4 bg-red-500 text-white text-[10px] flex items-center justify-center rounded-full border-2 border-white">
                        {{ $pendingCount }}
                    </span>
                @endif
            </a>
            <div class="h-8 w-[1px] bg-gray-200"></div>
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-slate-800">{{ auth()->guard('super_admin')->user()->name }}</p>
                    <p class="text-[10px] text-gray-500 uppercase tracking-tighter">System Manager</p>
                </div>
                <img src="https://ui-avatars.com/api/?name=Super+Admin&background=0f172a&color=fff" class="w-10 h-10 rounded-xl shadow-sm border border-gray-200">
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="p-8 space-y-8">
        
        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Card: Total Klub --}}
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all group">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl group-hover:bg-blue-600 group-hover:text-white transition-all">
                        <i class="fas fa-swimming-pool text-xl"></i>
                    </div>
                    <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-lg">+{{ \App\Models\Club::whereMonth('created_at', now()->month)->count() }} MoM</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium">Total Registered Clubs</h3>
                <p class="text-2xl font-bold text-slate-800 mt-1">{{ number_format($total_clubs) }}</p>
            </div>

            {{-- Card: Total Atlet --}}
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all group">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl group-hover:bg-indigo-600 group-hover:text-white transition-all">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                </div>
                <h3 class="text-gray-500 text-sm font-medium">Verified Athletes</h3>
                <p class="text-2xl font-bold text-slate-800 mt-1">{{ number_format($total_athletes) }}</p>
            </div>

            {{-- Card: Total Event --}}
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all group">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-purple-50 text-purple-600 rounded-2xl group-hover:bg-purple-600 group-hover:text-white transition-all">
                        <i class="fas fa-calendar-check text-xl"></i>
                    </div>
                </div>
                <h3 class="text-gray-500 text-sm font-medium">Total Competitions</h3>
                <p class="text-2xl font-bold text-slate-800 mt-1">{{ number_format($total_events) }}</p>
            </div>

            {{-- Card: Pending Approvals --}}
            <div class="bg-slate-card p-6 rounded-3xl shadow-xl transition-all relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-slate-400 text-sm font-medium">Action Required</h3>
                    <p class="text-3xl font-bold text-white mt-1">{{ $pendingCount }}</p>
                    <a href="{{ route('super.approval.index') }}" class="text-blue-400 text-xs mt-4 flex items-center gap-2 hover:text-blue-300 transition-colors">
                        Review Submissions <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
                <i class="fas fa-shield-alt absolute -bottom-4 -right-4 text-white/5 text-8xl"></i>
            </div>
        </div>

        {{-- Second Row: Activity & New Users --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- New Registered Clubs --}}
            <div class="lg:col-span-2 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                    <h3 class="font-bold text-slate-800">Recently Registered Clubs</h3>
                    <a href="{{ route('super.users.index') }}" class="text-xs text-blue-600 font-bold hover:underline">View All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Club Name</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Region</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach(\App\Models\Club::latest()->take(5)->get() as $club)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs">
                                            {{ substr($club->name, 0, 1) }}
                                        </div>
                                        <span class="text-sm font-semibold text-slate-700">{{ $club->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $club->city }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-full">Active</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-400">{{ $club->created_at->format('d/m/y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Quick System Actions --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
                <h3 class="font-bold text-slate-800 mb-6">Quick Actions</h3>
                <div class="space-y-4">
                    <button class="w-full p-4 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-2xl flex items-center gap-4 transition-all">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm">
                            <i class="fas fa-plus"></i>
                        </div>
                        <span class="font-bold text-sm">Create New Operator</span>
                    </button>
                    <button class="w-full p-4 bg-slate-50 hover:bg-slate-100 text-slate-700 rounded-2xl flex items-center gap-4 transition-all">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm">
                            <i class="fas fa-file-export"></i>
                        </div>
                        <span class="font-bold text-sm">Export System Audit</span>
                    </button>
                    <div class="p-6 bg-amber-50 rounded-3xl border border-amber-100 mt-6">
                        <p class="text-amber-800 font-bold text-sm flex items-center gap-2">
                            <i class="fas fa-exclamation-triangle"></i> Security Note
                        </p>
                        <p class="text-amber-600 text-[11px] mt-2 leading-relaxed">
                            Pastikan Anda selalu melakukan audit berkala terhadap pengajuan perubahan data atlet demi validitas rekor.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
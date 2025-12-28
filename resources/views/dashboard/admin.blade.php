@extends('layouts.dashboard')

@section('title', 'Event Manager Portal - Admin')

@section('styles')
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .bg-indigo-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);
        }
    </style>
@endsection

@section('content')
    {{-- Header --}}
    <header class="glass-effect border-b border-gray-200/60 h-20 flex items-center justify-between px-8 sticky top-0 z-30">
        <div>
            <h2 class="text-xl font-bold text-indigo-900 uppercase tracking-tight">Event Management</h2>
            <p class="text-[10px] font-bold text-indigo-500 mt-0.5 tracking-widest uppercase">Operator Console</p>
        </div>

        <div class="flex items-center gap-6">
            {{-- Status Operasional --}}
            <div class="hidden md:flex items-center gap-2 bg-indigo-50 px-4 py-2 rounded-xl border border-indigo-100">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                </span>
                <span class="text-xs font-bold text-indigo-700 uppercase tracking-wider">System Active</span>
            </div>

            <div class="h-8 w-[1px] bg-gray-200"></div>

            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-slate-800">{{ auth()->guard('admin')->user()->name }}</p>
                    <p class="text-[10px] text-gray-500 uppercase tracking-tighter">Event Operator</p>
                </div>
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->guard('admin')->user()->name) }}&background=4f46e5&color=fff" 
                     class="w-10 h-10 rounded-xl shadow-sm border border-gray-200">
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="p-8 space-y-8">
        
        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Card: Active Events --}}
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all group">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl group-hover:bg-indigo-600 group-hover:text-white transition-all">
                        <i class="fas fa-stopwatch text-xl"></i>
                    </div>
                </div>
                <h3 class="text-gray-500 text-sm font-medium">Active Competitions</h3>
                <p class="text-2xl font-bold text-slate-800 mt-1">{{ \App\Models\Event::where('status', 'active')->count() }}</p>
            </div>

            {{-- Card: Total Entries --}}
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all group">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl group-hover:bg-blue-600 group-hover:text-white transition-all">
                        <i class="fas fa-file-signature text-xl"></i>
                    </div>
                </div>
                <h3 class="text-gray-500 text-sm font-medium">New Registrations</h3>
                <p class="text-2xl font-bold text-slate-800 mt-1">124</p> {{-- Placeholder --}}
            </div>

            {{-- Card: Total Clubs Participating --}}
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all group">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-violet-50 text-violet-600 rounded-2xl group-hover:bg-violet-600 group-hover:text-white transition-all">
                        <i class="fas fa-flag text-xl"></i>
                    </div>
                </div>
                <h3 class="text-gray-500 text-sm font-medium">Clubs Involved</h3>
                <p class="text-2xl font-bold text-slate-800 mt-1">{{ \App\Models\Club::count() }}</p>
            </div>

            {{-- Card: Quick Event Creation --}}
            <div class="bg-indigo-gradient p-6 rounded-3xl shadow-xl transition-all relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-indigo-200 text-sm font-medium uppercase tracking-widest">Setup New</h3>
                    <p class="text-2xl font-bold text-white mt-1">Competition</p>
                    <a href="{{ Route::has('admin.event.create') ? route('admin.event.create') : '#' }}" class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 text-white text-[10px] font-bold py-2 px-4 rounded-xl mt-4 transition-all uppercase tracking-tighter">
                        <i class="fas fa-plus-circle"></i> Create Event
                    </a>
                </div>
                <i class="fas fa-medal absolute -bottom-4 -right-4 text-white/10 text-8xl"></i>
            </div>
        </div>

        {{-- Main Action Row --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Upcoming Events List --}}
            <div class="lg:col-span-2 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-slate-800">Managed Competitions</h3>
                        <p class="text-xs text-gray-400 mt-1">Schedule and registration status</p>
                    </div>
                    <a href="{{ Route::has('admin.event.index') ? route('admin.event.index') : '#' }}" class="text-xs text-indigo-600 font-bold hover:underline">Manage All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Event Name</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Category</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse(\App\Models\Event::latest()->take(5)->get() as $event)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 font-bold text-slate-700 text-sm">{{ $event->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $event->type ?? 'Open National' }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-bold rounded-full uppercase tracking-tighter">
                                        {{ $event->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="text-indigo-600 hover:text-indigo-900 font-bold text-xs uppercase">Edit</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-400 text-sm italic">
                                    No events found in the system.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Operational Checklist --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
                <h3 class="font-bold text-slate-800 mb-6">Operator Tasklist</h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-gray-50 border border-gray-100">
                        <div class="w-6 h-6 rounded-md border-2 border-indigo-200 flex-shrink-0"></div>
                        <span class="text-sm font-medium text-slate-600">Verify Event Results</span>
                    </div>
                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-gray-50 border border-gray-100">
                        <div class="w-6 h-6 rounded-md border-2 border-indigo-200 flex-shrink-0"></div>
                        <span class="text-sm font-medium text-slate-600">Sync Meet Rank Data</span>
                    </div>
                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-indigo-50 border border-indigo-100">
                        <i class="fas fa-check-square text-indigo-600"></i>
                        <span class="text-sm font-bold text-indigo-700">Publish Meet Schedule</span>
                    </div>
                    
                    <div class="p-5 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl mt-6 text-white">
                        <p class="text-[10px] font-bold uppercase tracking-widest opacity-80">Support Hotline</p>
                        <p class="text-sm font-bold mt-1 italic">Technical Issue? Contact System Root.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
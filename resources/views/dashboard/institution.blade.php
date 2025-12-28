@extends('layouts.dashboard')

@section('title', 'Portal Institusi - Swim Base')

@section('styles')
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .bg-gradient-institution {
            background: linear-gradient(135deg, #059669 0%, #064e3b 100%);
        }
    </style>
@endsection

@section('content')
    {{-- Header --}}
    <header class="glass-effect border-b border-gray-200/60 h-20 flex items-center justify-between px-8 sticky top-0 z-30">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Panel Institusi</h2>
            <p class="text-xs text-emerald-600 font-medium mt-0.5">
                {{ auth()->guard('institution')->user()->name }}
            </p>
        </div>

        <div class="flex items-center gap-6">
            {{-- Status Akademik/Sertifikasi --}}
            <div class="hidden lg:flex items-center gap-2 bg-emerald-50 px-4 py-2 rounded-xl border border-emerald-100">
                <i class="fas fa-check-circle text-emerald-500 text-sm"></i>
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider">Verified Institution</span>
            </div>

            <div class="h-8 w-[1px] bg-gray-200"></div>

            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="text-sm font-bold text-gray-800">Akademik Portal</p>
                    <p class="text-[10px] text-gray-400 uppercase tracking-tighter">School Administrator</p>
                </div>
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->guard('institution')->user()->name) }}&background=10b981&color=fff" 
                     class="w-10 h-10 rounded-xl shadow-sm border border-gray-100">
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="p-8 space-y-8">
        
        {{-- Banner Selamat Datang --}}
        <div class="bg-gradient-institution rounded-[2rem] p-8 text-white relative overflow-hidden shadow-xl shadow-emerald-900/10">
            <div class="relative z-10 max-w-2xl">
                <h1 class="text-3xl font-bold mb-2">Selamat Datang, Tim Olahraga!</h1>
                <p class="text-emerald-100 text-sm leading-relaxed opacity-90">
                    Kelola data capaian prestasi atlet yang mewakili instansi Anda. Pastikan setiap rekor dan keikutsertaan event tercatat dengan valid untuk sistem pemeringkatan.
                </p>
                <div class="mt-6 flex gap-4">
                    <button class="bg-white text-emerald-800 px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-emerald-50 transition-all">
                        Unduh Rekapitulasi
                    </button>
                    <button class="bg-emerald-500/30 border border-emerald-400/30 text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-emerald-500/50 transition-all">
                        Panduan Portal
                    </button>
                </div>
            </div>
            <i class="fas fa-graduation-cap absolute -bottom-10 -right-10 text-white/10 text-[15rem]"></i>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Total Atlet Institusi --}}
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5">
                <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-xl">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div>
                    <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider">Atlet Terdaftar</h3>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($my_athletes) }}</p>
                </div>
            </div>

            {{-- Partisipasi Event --}}
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5">
                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl">
                    <i class="fas fa-medal"></i>
                </div>
                <div>
                    <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider">Total Prestasi</h3>
                    <p class="text-2xl font-bold text-gray-800">12</p> {{-- Placeholder --}}
                </div>
            </div>

            {{-- Point Institusi --}}
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5">
                <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center text-xl">
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider">Poin Institusi</h3>
                    <p class="text-2xl font-bold text-gray-800">1,240</p> {{-- Placeholder --}}
                </div>
            </div>
        </div>

        {{-- Bottom Section: List Atlet Terkini --}}
        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-gray-50 flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-gray-800 text-lg">Daftar Atlet Instansi</h3>
                    <p class="text-xs text-gray-400 mt-1">Atlet yang mewakili sekolah/universitas Anda</p>
                </div>
                <button class="bg-gray-50 text-gray-600 px-4 py-2 rounded-xl text-xs font-bold hover:bg-gray-100 transition-all">
                    Lihat Semua Atlet
                </button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Nama Atlet</th>
                            <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">NISN / NIM</th>
                            <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Kategori</th>
                            <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        {{-- Contoh Data --}}
                        @forelse(\App\Models\Athlete::where('institution_id', auth()->guard('institution')->id())->take(5)->get() as $athlete)
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="px-8 py-4 font-bold text-gray-700 text-sm">{{ $athlete->name }}</td>
                            <td class="px-8 py-4 text-gray-500 text-sm">12345678</td>
                            <td class="px-8 py-4 text-gray-500 text-sm">{{ $athlete->category ?? 'Umum' }}</td>
                            <td class="px-8 py-4">
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-bold rounded-full">Aktif</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-12 text-center text-gray-400 text-sm">
                                <i class="fas fa-folder-open block text-3xl mb-3"></i>
                                Belum ada atlet terdaftar untuk instansi ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
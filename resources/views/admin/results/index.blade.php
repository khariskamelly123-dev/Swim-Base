@extends('layouts.dashboard')

@section('title', 'Input Hasil Lomba - Swim Base')

@section('styles')
    <style>
        .input-focus-indigo:focus {
            border-color: #4f46e5;
            ring-color: #4f46e5;
            outline: none;
        }
    </style>
@endsection

@section('content')
    <div class="p-8">
        {{-- Breadcrumb & Title --}}
        <div class="mb-8 flex justify-between items-end">
            <div>
                <nav class="flex text-gray-400 text-xs mb-2 gap-2">
                    <span>Manajemen Lomba</span>
                    <span>/</span>
                    <span class="text-indigo-600 font-semibold">Input Hasil</span>
                </nav>
                <h1 class="text-2xl font-bold text-slate-800">Input Hasil Perlombaan</h1>
                <p class="text-sm text-gray-500 mt-1">Masukkan catatan waktu resmi atlet berdasarkan Heat dan Lane.</p>
            </div>

            {{-- Filter Quick Select --}}
            <div class="flex gap-4">
                <select class="bg-white border border-gray-200 text-sm rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 outline-none shadow-sm">
                    <option>Pilih Event...</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Form Input Utama --}}
        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
            {{-- Info Lomba --}}
            <div class="p-6 bg-indigo-50/50 border-b border-gray-100 flex flex-wrap gap-8 items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white">
                        <i class="fas fa-stopwatch"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-indigo-400 font-bold uppercase tracking-wider">Nomor Lomba</p>
                        <p class="text-sm font-bold text-indigo-900">50m Gaya Bebas Putra - KU 1</p>
                    </div>
                </div>
                <div class="h-10 w-[1px] bg-indigo-100 hidden md:block"></div>
                <div>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Heat / Seri</p>
                    <p class="text-sm font-bold text-gray-700">01 dari 05</p>
                </div>
            </div>

            {{-- Tabel Input --}}
            <form action="#" method="POST">
                @csrf
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/50 border-b border-gray-100">
                            <tr>
                                <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest w-20">Lintasan</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Nama Atlet</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Klub / Institusi</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest w-48">Waktu (MM:SS.ms)</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @for ($i = 1; $i <= 8; $i++)
                            <tr class="hover:bg-indigo-50/30 transition-all">
                                <td class="px-8 py-4 text-center font-bold text-indigo-600 bg-indigo-50/20">{{ $i }}</td>
                                <td class="px-8 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-gray-700">Nama Atlet ke-{{ $i }}</span>
                                        <span class="text-[10px] text-gray-400 uppercase">ID: AT-00{{ $i }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-4 text-sm text-gray-500">Klub Renang Tirta Kencana</td>
                                <td class="px-8 py-4">
                                    <input type="text" 
                                           placeholder="00:28.45" 
                                           name="time[]"
                                           class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-sm font-mono focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                                    >
                                </td>
                                <td class="px-8 py-4">
                                    <select name="status[]" class="bg-transparent text-xs font-bold text-gray-500 outline-none border-none focus:ring-0">
                                        <option value="OK">OK</option>
                                        <option value="DQ">DQ (Diskualifikasi)</option>
                                        <option value="DNS">DNS (Tidak Start)</option>
                                        <option value="DNF">DNF (Tidak Finish)</option>
                                    </select>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                {{-- Action Footer --}}
                <div class="p-8 bg-gray-50/50 border-t border-gray-100 flex justify-between items-center">
                    <div class="text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i> Data akan otomatis masuk ke peringkat nasional (Meet Rank) setelah disimpan.
                    </div>
                    <div class="flex gap-3">
                        <button type="button" class="px-6 py-2.5 rounded-xl border border-gray-200 text-gray-600 text-sm font-bold hover:bg-white transition-all">
                            Batal
                        </button>
                        <button type="submit" class="px-8 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-bold hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all flex items-center gap-2">
                            <i class="fas fa-save"></i> Simpan Hasil
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
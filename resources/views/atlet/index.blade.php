@extends('layouts.dashboard')

@section('content')
<div class="p-6 space-y-6">
    
    {{-- BAGIAN HEADER & TOMBOL TAMBAH --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Manajemen Atlet</h2>
            <p class="text-sm text-gray-500">Kelola data atlet renang klub Anda.</p>
        </div>
        
        <a href="{{ route('atlet.create') }}" 
           class="inline-flex items-center px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-xl transition-colors shadow-sm gap-2">
            <i class="fas fa-plus"></i>
            <span>Tambah Atlet</span>
        </a>
    </div>

    {{-- BAGIAN STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] flex items-center gap-4 transition-transform hover:-translate-y-1">
            <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-red-600 shadow-sm">
                <i class="fas fa-swimmer text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Atlet</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $total_atlet }}</h3>
            </div>
        </div>
    </div>

    {{-- BAGIAN TABEL DATA --}}
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                        <th class="px-6 py-4 font-semibold">Nama Atlet</th>
                        
                        {{-- REVISI: Kolom Dipisah --}}
                        <th class="px-6 py-4 font-semibold">Tempat Lahir</th>
                        <th class="px-6 py-4 font-semibold">Tanggal Lahir</th>
                        
                        <th class="px-6 py-4 font-semibold">Gaya Utama</th>
                        <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($atlet as $a)
                    <tr class="hover:bg-gray-50 transition-colors group">
                        
                        {{-- Nama --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-100 to-red-50 text-red-600 flex items-center justify-center font-bold text-xs border border-red-100">
                                    {{ substr($a->nama, 0, 2) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $a->nama }}</p>
                                    <p class="text-xs text-gray-400">ID: {{ $a->id }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- REVISI: Kolom Tempat Lahir Sendiri --}}
                        <td class="px-6 py-4 text-gray-600">
                            {{ $a->tempat ?? '-' }}
                        </td>

                        {{-- REVISI: Kolom Tanggal Lahir Sendiri --}}
                        <td class="px-6 py-4 text-gray-600">
                            {{ $a->tanggal_lahir ? \Carbon\Carbon::parse($a->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                        </td>

                        {{-- Gaya Utama / Cabang --}}
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                {{ $a->kategori_renang ?? 'Belum diset' }}
                            </span>
                        </td>

                        {{-- Aksi --}}
                        {{-- Di dalam loop tabel --}}
<td class="px-6 py-4 text-right">
    <div class="flex items-center justify-end gap-2">
        
        {{-- Tombol Edit --}}
        <a href="{{ route('atlet.edit', $a->id) }}" class="p-2 text-amber-500 hover:bg-amber-50 rounded-lg" title="Edit">
            <i class="fas fa-edit"></i>
        </a>

        {{-- Tombol Request Hapus --}}
        <form action="{{ route('atlet.request_delete', $a->id) }}" method="POST" 
              onsubmit="return confirm('Ajukan penghapusan atlet ini ke Admin?');">
            @csrf
            <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg" title="Ajukan Hapus">
                <i class="fas fa-trash-alt"></i>
            </button>
        </form>

    </div>
</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <div class="flex flex-col items-center justify-center gap-3">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300">
                                    <i class="fas fa-swimmer text-3xl"></i>
                                </div>
                                <p class="font-medium">Belum ada data atlet.</p>
                                <p class="text-xs text-gray-400">Silakan tambahkan data baru untuk memulai.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
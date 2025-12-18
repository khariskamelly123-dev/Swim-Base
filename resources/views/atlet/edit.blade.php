@extends('layouts.dashboard')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Ajukan Perubahan Data</h2>
        <div class="flex items-center gap-2 mt-2 px-3 py-2 bg-yellow-50 text-yellow-700 rounded-lg text-sm border border-yellow-200">
            <i class="fas fa-info-circle"></i>
            <span>Data tidak akan langsung berubah. Admin akan meninjau pengajuan Anda terlebih dahulu.</span>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden max-w-3xl">
        
        {{-- UPDATE: Action mengarah ke request_update --}}
        <form action="{{ route('atlet.request_update', $atlet->id) }}" method="POST">
            @csrf
            {{-- Note: Kita pakai POST, bukan PUT/PATCH karena ini create data baru di tabel pengajuan --}}

            <div class="p-8 space-y-6">

                {{-- Input Data Atlet (Sama seperti sebelumnya) --}}
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $atlet->nama) }}" 
                           class="w-full pl-4 pr-4 py-2.5 rounded-xl border border-gray-200 focus:ring-red-200 outline-none" required>
                </div>

                {{-- ... Masukkan input Tempat Lahir, Tgl Lahir, Gaya Utama di sini ... --}}
                {{-- Tips: Copy paste saja dari create.blade.php lalu beri value="{{ $atlet->... }}" --}}

                <hr class="border-gray-100">

                {{-- UPDATE: Input Alasan --}}
                <div class="space-y-2">
                    <label for="alasan" class="text-sm font-semibold text-gray-700">Alasan Perubahan <span class="text-red-500">*</span></label>
                    <textarea name="alasan" id="alasan" rows="3" required
                              class="w-full p-3 rounded-xl border border-gray-200 focus:border-red-500 outline-none"
                              placeholder="Contoh: Typo nama, ganti spesialisasi, dll."></textarea>
                </div>

            </div>

            <div class="px-8 py-5 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('atlet.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-200">Batal</a>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-600 shadow-md transition-all">
                    <i class="fas fa-paper-plane mr-2"></i> Kirim Pengajuan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
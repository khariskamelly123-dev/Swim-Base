@extends('layouts.dashboard')

@section('content')
{{-- Load CSS Select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single {
        height: 46px !important;
        border: 1px solid #e5e7eb !important;
        border-radius: 0.75rem !important;
        padding: 0.5rem 0.75rem !important;
        display: flex;
        align-items: center;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 44px !important;
        right: 10px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #4b5563 !important;
        padding-left: 2rem !important;
        font-size: 0.875rem !important;
    }
</style>

<div class="p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Ajukan Perubahan Data</h2>
        <div class="flex items-center gap-2 mt-2 px-3 py-2 bg-yellow-50 text-yellow-700 rounded-lg text-sm border border-yellow-200">
            <i class="fas fa-info-circle"></i>
            <span>Data tidak akan langsung berubah. Admin akan meninjau pengajuan Anda terlebih dahulu.</span>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden max-w-3xl">
        
        {{-- UPDATE: Route diarahkan ke method 'submitUpdate' di Controller --}}
        {{-- Pastikan di web.php route namenya: name('athlete.submit_update') --}}
        <form action="{{ route('athlete.submit_update', $athlete->id) }}" method="POST">
            @csrf
            {{-- Kita pakai POST karena ini membuat record baru di tabel submissions --}}

            <div class="p-8 space-y-6">

                {{-- 1. Nama Lengkap --}}
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        {{-- Ubah name='nama' jadi 'name' --}}
                        <input type="text" name="name" value="{{ old('name', $athlete->name) }}" 
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:ring-red-200 outline-none" required>
                    </div>
                </div>

                {{-- 2. Grid Tempat & Tanggal Lahir --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        {{-- Provinsi (Helper) --}}
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-700">Provinsi</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-20">
                                    <i class="fas fa-map text-gray-400"></i>
                                </div>
                                <select id="select_provinsi" class="w-full pl-10">
                                    <option value="">Pilih Provinsi (Untuk Mengubah Kota)...</option>
                                </select>
                            </div>
                        </div>

                        {{-- Kota/Kabupaten --}}
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-700">Kabupaten/Kota</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-20">
                                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                                </div>
                                {{-- Ubah name='tempat' jadi 'birth_place' --}}
                                <select name="birth_place" id="select_kota" class="w-full pl-10">
                                    {{-- Tampilkan Data Lama Sebagai Option Default --}}
                                    <option value="{{ $athlete->birth_place }}" selected>{{ $athlete->birth_place }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Tanggal Lahir</label>
                        <div class="h-[74px] md:block hidden"></div>
                        <div class="relative -mt-[74px] md:mt-0">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-calendar-alt text-gray-400"></i>
                            </div>
                            <input type="date" name="birth_date" 
                                   value="{{ old('birth_date', $athlete->birth_date) }}"
                                   class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:ring-red-200 outline-none">
                        </div>
                    </div>
                </div>

                {{-- 3. Spesialisasi --}}
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Spesialisasi / Gaya Utama</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-swimmer text-gray-400"></i>
                        </div>
                        {{-- Ubah name jadi 'swimming_category' --}}
                        <select name="swimming_category" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 outline-none appearance-none bg-white">
                            @php $cat = old('swimming_category', $athlete->swimming_category); @endphp
                            
                            <option value="Gaya Bebas (Freestyle)" {{ $cat == 'Gaya Bebas (Freestyle)' ? 'selected' : '' }}>Gaya Bebas (Freestyle)</option>
                            <option value="Gaya Dada (Breaststroke)" {{ $cat == 'Gaya Dada (Breaststroke)' ? 'selected' : '' }}>Gaya Dada (Breaststroke)</option>
                            <option value="Gaya Punggung (Backstroke)" {{ $cat == 'Gaya Punggung (Backstroke)' ? 'selected' : '' }}>Gaya Punggung (Backstroke)</option>
                            <option value="Gaya Kupu-kupu (Butterfly)" {{ $cat == 'Gaya Kupu-kupu (Butterfly)' ? 'selected' : '' }}>Gaya Kupu-kupu (Butterfly)</option>
                            <option value="Sprinter (Jarak Pendek)" {{ $cat == 'Sprinter (Jarak Pendek)' ? 'selected' : '' }}>Sprinter (Jarak Pendek)</option>
                            <option value="Distance (Jarak Jauh)" {{ $cat == 'Distance (Jarak Jauh)' ? 'selected' : '' }}>Distance (Jarak Jauh)</option>
                            <option value="Pemula / Fun Swim" {{ $cat == 'Pemula / Fun Swim' ? 'selected' : '' }}>Pemula / Fun Swim</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-100">

                {{-- 4. Alasan (Wajib) --}}
                <div class="space-y-2">
                    <label for="reason" class="text-sm font-semibold text-gray-700">Alasan Perubahan <span class="text-red-500">*</span></label>
                    {{-- Ubah name='alasan' jadi 'reason' --}}
                    <textarea name="reason" id="reason" rows="3" required
                              class="w-full p-3 rounded-xl border border-gray-200 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100 outline-none transition-all"
                              placeholder="Contoh: Typo nama, ganti spesialisasi, dll."></textarea>
                </div>

            </div>

            <div class="px-8 py-5 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3">
                {{-- Ubah route ke athlete.index --}}
                <a href="{{ route('athlete.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-200">Batal</a>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-600 shadow-md transition-all">
                    <i class="fas fa-paper-plane mr-2"></i> Kirim Pengajuan
                </button>
            </div>

        </form>
    </div>
</div>

{{-- Script Select2 --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#select_provinsi').select2({ placeholder: "Ganti Provinsi...", allowClear: true });
        $('#select_kota').select2({ placeholder: "Kota/Kabupaten", allowClear: true });

        // Load Provinsi
        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
            .then(response => response.json())
            .then(provinces => {
                let options = '<option value="">Pilih Provinsi...</option>';
                provinces.forEach(province => {
                    options += `<option value="${province.id}">${province.name}</option>`;
                });
                $('#select_provinsi').append(options);
            });

        // Logika Ganti Provinsi -> Reset Kota
        $('#select_provinsi').on('change', function() {
            let provinceId = $(this).val();
            let kotaSelect = $('#select_kota');
            
            // Kosongkan option lama (termasuk data birth_place yang tersimpan)
            kotaSelect.empty().trigger('change');
            kotaSelect.html('<option value="">Memuat...</option>').prop('disabled', true);

            if (provinceId) {
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`)
                    .then(response => response.json())
                    .then(regencies => {
                        let options = '<option value="">Pilih Kabupaten/Kota...</option>';
                        regencies.forEach(regency => {
                            options += `<option value="${regency.name}">${regency.name}</option>`;
                        });
                        kotaSelect.html(options).prop('disabled', false);
                    });
            }
        });
    });
</script>
@endsection
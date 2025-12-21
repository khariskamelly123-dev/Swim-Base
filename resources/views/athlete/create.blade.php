@extends('layouts.dashboard')

@section('content')
{{-- Tambahkan CSS Select2 agar dropdown terlihat bagus --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Styling Custom agar Select2 mirip dengan Input Tailwind kamu */
    .select2-container .select2-selection--single {
        height: 46px !important;
        border: 1px solid #e5e7eb !important; /* gray-200 */
        border-radius: 0.75rem !important; /* rounded-xl */
        padding: 0.5rem 0.75rem !important;
        display: flex;
        align-items: center;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 44px !important;
        right: 10px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #4b5563 !important; /* gray-600 */
        padding-left: 2rem !important; /* space for icon */
        font-size: 0.875rem !important;
    }
    .select2-container--focus .select2-selection--single {
        border-color: #ef4444 !important; /* red-500 */
        ring: 2px solid #fecaca !important; /* red-200 */
    }
</style>

<div class="p-6">
    
    {{-- Header Halaman --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Atlet Baru</h2>
        <p class="text-sm text-gray-500">Lengkapi formulir di bawah ini untuk mendaftarkan atlet renang baru.</p>
    </div>

    {{-- Form Container --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden max-w-3xl">
        
        {{-- Action mengarah ke route 'athlete.store' --}}
        <form action="{{ route('athlete.store') }}" method="POST">
            @csrf

            <div class="p-8 space-y-6">

                {{-- Input: Nama Lengkap --}}
                <div class="space-y-2">
                    <label for="name" class="text-sm font-semibold text-gray-700">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" name="name" id="name"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-red-500 focus:ring-2 focus:ring-red-200 outline-none transition-all placeholder-gray-400"
                               placeholder="Masukkan nama lengkap atlet" 
                               value="{{ old('name') }}" required>
                    </div>
                    @error('name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Grid untuk Tempat & Tanggal Lahir --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- AREA API: Tempat Lahir (Provinsi & Kota) --}}
                    <div class="space-y-4">
                        
                        {{-- 1. Input Provinsi (Hanya Pembantu, tidak dikirim ke DB) --}}
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-700">Provinsi</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-20">
                                    <i class="fas fa-map text-gray-400"></i>
                                </div>
                                <select id="select_provinsi" class="w-full pl-10">
                                    <option value="">Pilih Provinsi...</option>
                                </select>
                            </div>
                        </div>

                        {{-- 2. Input Kota/Kabupaten (Ini yang dikirim ke DB) --}}
                        <div class="space-y-2">
                            <label for="birth_place" class="text-sm font-semibold text-gray-700">Kabupaten/Kota (Tempat Lahir)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-20">
                                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                                </div>
                                
                                {{-- PERBAIKAN: Name diubah jadi "birth_place" --}}
                                <select name="birth_place" id="select_kota" class="w-full pl-10" disabled>
                                    <option value="">Pilih Provinsi Terlebih Dahulu</option>
                                </select>
                            </div>
                            
                            {{-- Error Message disesuaikan --}}
                            @error('birth_place')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- Input: Tanggal Lahir --}}
                    <div class="space-y-2">
                        <label for="birth_date" class="text-sm font-semibold text-gray-700">Tanggal Lahir</label>
                        {{-- Spacer biar sejajar dengan input kota yang agak turun --}}
                        <div class="h-[74px] md:block hidden"></div> 
                        
                        <div class="relative -mt-[74px] md:mt-0">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-calendar-alt text-gray-400"></i>
                            </div>
                            <input type="date" name="birth_date" id="birth_date" 
                                   class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-red-500 focus:ring-2 focus:ring-red-200 outline-none transition-all text-gray-600"
                                   value="{{ old('birth_date') }}">
                        </div>
                        @error('birth_date')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Input: Spesialisasi / Gaya Utama --}}
                <div class="space-y-2">
                    <label for="swimming_category" class="text-sm font-semibold text-gray-700">Spesialisasi / Gaya Utama</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-swimmer text-gray-400"></i>
                        </div>
                        
                        {{-- PERBAIKAN: Name diubah jadi "swimming_category" --}}
                        <select name="swimming_category" id="swimming_category" 
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-red-500 focus:ring-2 focus:ring-red-200 outline-none transition-all text-gray-600 bg-white appearance-none cursor-pointer">
                            <option value="" disabled selected>Pilih Gaya Utama Atlet</option>
                            
                            <optgroup label="Gaya Utama (Strokes)">
                                <option value="Gaya Bebas (Freestyle)" {{ old('swimming_category') == 'Gaya Bebas (Freestyle)' ? 'selected' : '' }}>Gaya Bebas (Freestyle)</option>
                                <option value="Gaya Dada (Breaststroke)" {{ old('swimming_category') == 'Gaya Dada (Breaststroke)' ? 'selected' : '' }}>Gaya Dada (Breaststroke)</option>
                                <option value="Gaya Punggung (Backstroke)" {{ old('swimming_category') == 'Gaya Punggung (Backstroke)' ? 'selected' : '' }}>Gaya Punggung (Backstroke)</option>
                                <option value="Gaya Kupu-kupu (Butterfly)" {{ old('swimming_category') == 'Gaya Kupu-kupu (Butterfly)' ? 'selected' : '' }}>Gaya Kupu-kupu (Butterfly)</option>
                                <option value="Gaya Ganti (Medley)" {{ old('swimming_category') == 'Gaya Ganti (Medley)' ? 'selected' : '' }}>Gaya Ganti (Individual Medley)</option>
                            </optgroup>

                            <optgroup label="Spesialisasi Jarak">
                                <option value="Sprinter (Jarak Pendek)" {{ old('swimming_category') == 'Sprinter (Jarak Pendek)' ? 'selected' : '' }}>Sprinter (Jarak Pendek)</option>
                                <option value="Distance (Jarak Jauh)" {{ old('swimming_category') == 'Distance (Jarak Jauh)' ? 'selected' : '' }}>Distance (Jarak Jauh)</option>
                            </optgroup>

                            <optgroup label="Lainnya">
                                <option value="Pemula / Fun Swim" {{ old('swimming_category') == 'Pemula / Fun Swim' ? 'selected' : '' }}>Pemula / Fun Swim</option>
                            </optgroup>
                        </select>
                        
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                        </div>
                    </div>
                    @error('swimming_category')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Footer Tombol --}}
            <div class="px-8 py-5 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3">
                {{-- PERBAIKAN: Route kembali ke athlete.index --}}
                <a href="{{ route('athlete.index') }}" 
                   class="px-5 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-200 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-5 py-2.5 rounded-xl text-sm font-medium text-white bg-red-600 hover:bg-red-700 shadow-md shadow-red-200 transition-all transform hover:-translate-y-0.5">
                    <i class="fas fa-save mr-2"></i> Simpan Data
                </button>
            </div>

        </form>
    </div>
</div>

{{-- SCRIPT UNTUK LOAD API & SELECT2 --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // 1. Inisialisasi Select2
        $('#select_provinsi').select2({
            placeholder: "Cari Provinsi...",
            allowClear: true
        });
        $('#select_kota').select2({
            placeholder: "Pilih Provinsi Dulu",
            allowClear: true
        });

        // 2. Ambil Data Provinsi dari API Emsifa
        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
            .then(response => response.json())
            .then(provinces => {
                let options = '<option value="">Pilih Provinsi...</option>';
                provinces.forEach(province => {
                    options += `<option value="${province.id}">${province.name}</option>`;
                });
                $('#select_provinsi').html(options);
            });

        // 3. Ketika Provinsi Dipilih -> Ambil Kota
        $('#select_provinsi').on('change', function() {
            let provinceId = $(this).val();
            let kotaSelect = $('#select_kota');

            // Reset & Disable dulu
            kotaSelect.html('<option value="">Memuat Kota...</option>').prop('disabled', true);

            if (provinceId) {
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`)
                    .then(response => response.json())
                    .then(regencies => {
                        let options = '<option value="">Pilih Kabupaten/Kota...</option>';
                        regencies.forEach(regency => {
                            // Value kita set NAMANYA agar masuk ke DB sebagai teks (birth_place)
                            options += `<option value="${regency.name}">${regency.name}</option>`;
                        });
                        kotaSelect.html(options).prop('disabled', false);
                        
                        // Re-init Select2 biar datanya ke-refresh
                        kotaSelect.select2({ placeholder: "Cari Kabupaten/Kota..." });
                    });
            } else {
                kotaSelect.html('<option value="">Pilih Provinsi Dulu</option>');
            }
        });
    });
</script>

@endsection
@extends('layouts.layout')

@section('title', 'Register Club - Swim Base')

@section('content')

    <style>
        * { box-sizing: border-box; }
        body, html {
            margin: 0; padding: 0; height: 100%;
            font-family: 'Roboto', sans-serif;
            color: white;
            background: url('/images/bg-swim.jpg') no-repeat center center fixed;
            background-size: cover;
            overflow: hidden;
            position: relative;
        }
        nav { background-color: #000000; padding: 1rem 2rem; z-index: 10; }
        .container {
            display: flex; justify-content: space-between; align-items: center;
            height: calc(100% - 72px); padding: 0 4rem; position: relative; z-index: 1;
        }
        .welcome-text { margin-left: 100px; }
        .welcome-text h1 { font-size: 3rem; font-weight: 900; margin-bottom: 0.5rem; }
        .welcome-text p { font-size: 1.25rem; color: #ddd; }

        /* Login Box Styling */
        .login-box {
            background-color: rgba(0, 0, 0, 0.55);
            padding: 2rem;
            border-radius: 16px;
            margin-right: 150px;
            width: 500px;
            max-height: 85vh; /* Agar bisa discroll jika layar pendek */
            overflow-y: auto; /* Scrollbar otomatis */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            /* Custom Scrollbar */
            scrollbar-width: thin;
            scrollbar-color: #d22222 transparent;
        }

        .login-box h2 { text-align: center; font-size: 1.5rem; margin-bottom: 1.5rem; color: #fff; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-row.full { grid-template-columns: 1fr; }
        .login-box label { display: block; font-weight: 600; margin-bottom: 0.25rem; color: #eee; font-size: 0.9rem; }
        
        .input-icon { position: relative; width: 100%; margin-bottom: 1rem; }
        
        /* Styling Input & Select agar seragam */
        .input-icon input, 
        .input-icon select {
            width: 100%; height: 45px;
            padding-left: 15px; /* Disesuaikan karena icon dihapus di beberapa field */
            border-radius: 8px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            background: transparent;
            color: #fff;
            font-size: 15px;
            outline: none;
            appearance: none; /* Hilangkan panah default browser untuk select */
        }

        /* Khusus input yang ada iconnya */
        .with-icon input { padding-left: 48px; }
        .with-icon .icon {
            width: 22px; height: 22px; position: absolute;
            left: 14px; top: 50%; transform: translateY(-50%); opacity: 0.9;
        }

        /* Styling Option di dalam Select (Agar terbaca di background putih/hitam) */
        .input-icon select option {
            background-color: #222; /* Background gelap saat dropdown dibuka */
            color: white;
        }

        .input-icon input::placeholder { color: #cfcfcf; }
        
        .login-btn {
            width: 100%; padding: 0.75rem; border-radius: 8px; border: none;
            background-color: white; color: black; font-weight: 700; font-size: 1.1rem;
            cursor: pointer; margin-bottom: 1rem; transition: 0.3s ease; margin-top: 10px;
        }
        .login-btn:hover { background-color: #d22222; color: white; }

        .eye-btn {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer; padding: 0;
        }
        .eye-btn img { width: 22px; opacity: 0.9; }

        .signup-text { text-align: center; font-size: 0.9rem; color: #ccc; margin-top: 1rem; }
        .signup-text a { color: #4ea1d3; font-weight: 600; text-decoration: none; }
        .signup-text a:hover { text-decoration: underline; }

        /* Loading Spinner Kecil untuk Dropdown */
        .loading-text {
            position: absolute; right: 10px; top: 12px; font-size: 12px; color: #aaa;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .container { flex-direction: column; text-align: center; padding: 2rem; justify-content: center; }
            .welcome-text { margin: 0; margin-bottom: 2rem; }
            .login-box { margin: 0; width: 100%; max-width: 360px; }
            .form-row { grid-template-columns: 1fr; } /* Stack form di mobile */
        }
    </style>

    <div class="container">
        <div class="welcome-text">
            <h1>Welcome to Swim Base!</h1>
            <p>Register your club account</p>
        </div>

        <div class="login-box">
            <h2>Register Club</h2>

            <form action="{{ route('club.register.process') }}" method="POST">
                @csrf

                <div class="form-row full">
                    <div>
                        <label for="nama_klub">Nama Klub</label>
                        <div class="input-icon">
                            <input type="text" id="nama_klub" name="nama_klub" placeholder="Masukkan nama klub" required>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label for="provinsi">Provinsi</label>
                        <div class="input-icon">
                            <select id="provinsi" name="provinsi" required>
                                <option value="" disabled selected>Pilih Provinsi...</option>
                            </select>
                            <input type="hidden" id="provinsi_nama" name="provinsi_nama">
                        </div>
                    </div>
                    <div>
                        <label for="kota">Kabupaten/Kota</label>
                        <div class="input-icon">
                            <select id="kota" name="kota" required disabled>
                                <option value="" disabled selected>Pilih Provinsi dulu...</option>
                            </select>
                            <input type="hidden" id="kota_nama" name="kota_nama">
                            <span id="loading-kota" class="loading-text" style="display:none;">Loading...</span>
                        </div>
                    </div>
                </div>

                <div class="form-row full">
                    <div>
                        <label for="alamat_detail">Detail Alamat</label>
                        <div class="input-icon">
                            <input type="text" id="alamat_detail" name="alamat_detail" 
                                   placeholder="Nama Jalan, RT/RW, Kecamatan" required>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label for="kontak_club">Kontak Club (WA)</label>
                        <div class="input-icon">
                            <input type="tel" id="kontak_club" name="kontak_club" placeholder="08xxxxx" required>
                        </div>
                    </div>
                    <div>
                        <label for="email_resmi">Email Login</label>
                        <div class="input-icon">
                            <input type="email" id="email_resmi" name="email_resmi" placeholder="email@club.com" required>
                        </div>
                    </div>
                </div>

                <div class="form-row full">
                    <div>
                        <label for="password">Password</label>
                        <div class="input-icon with-icon"> <input id="password-field" type="password" name="password" placeholder="Buat password" required>
                            <button type="button" class="eye-btn" onclick="togglePassword()">
                                <img id="eye-icon" src="{{ asset('images/eye-icon.png') }}">
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="login-btn">Register</button>

            </form>
            <div class="signup-text">
                Sudah punya akun? <a href="{{ route('club.login') }}">Login di sini</a>
            </div>
        </div>
    </div>

    <script>
        // 1. Logic Toggle Password
        function togglePassword() {
            const pass = document.getElementById("password-field");
            const icon = document.getElementById("eye-icon");
            if (pass.type === "password") {
                pass.type = "text";
                icon.style.opacity = "1";
            } else {
                pass.type = "password";
                icon.style.opacity = "0.8";
            }
        }

        // 2. Logic API Wilayah Indonesia
        document.addEventListener("DOMContentLoaded", function() {
            const selectProvinsi = document.getElementById('provinsi');
            const selectKota = document.getElementById('kota');
            const inputProvinsiNama = document.getElementById('provinsi_nama');
            const inputKotaNama = document.getElementById('kota_nama');
            const loadingKota = document.getElementById('loading-kota');

            // URL API Static (Cepat & Stabil)
            const apiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api';

            // Fetch Data Provinsi saat halaman load
            fetch(`${apiBaseUrl}/provinces.json`)
                .then(response => response.json())
                .then(provinces => {
                    provinces.forEach(province => {
                        const option = document.createElement('option');
                        option.value = province.id; // Value pakai ID untuk fetch kota nanti
                        option.textContent = province.name; // Teks yang tampil
                        option.setAttribute('data-name', province.name); // Simpan nama asli
                        selectProvinsi.appendChild(option);
                    });
                })
                .catch(err => console.error('Gagal memuat provinsi:', err));

            // Event saat Provinsi dipilih
            selectProvinsi.addEventListener('change', function() {
                const provinceId = this.value;
                const provinceName = this.options[this.selectedIndex].getAttribute('data-name');
                
                // Simpan nama provinsi ke hidden input (agar bisa dikirim ke database sebagai teks)
                inputProvinsiNama.value = provinceName;

                // Reset Dropdown Kota
                selectKota.innerHTML = '<option value="" disabled selected>Pilih Kota/Kabupaten...</option>';
                selectKota.disabled = true;
                loadingKota.style.display = 'block';

                // Fetch Kota berdasarkan ID Provinsi
                fetch(`${apiBaseUrl}/regencies/${provinceId}.json`)
                    .then(response => response.json())
                    .then(regencies => {
                        regencies.forEach(regency => {
                            const option = document.createElement('option');
                            // Disini Value kita set Nama saja biar gampang masuk database
                            // ATAU set ID jika database Anda pakai relasi ID.
                            // Di sini saya set Value = Nama Kota agar langsung tersimpan string "KAB. WONOSOBO"
                            option.value = regency.name; 
                            option.textContent = regency.name;
                            selectKota.appendChild(option);
                        });
                        selectKota.disabled = false;
                        loadingKota.style.display = 'none';
                    })
                    .catch(err => {
                        console.error('Gagal memuat kota:', err);
                        loadingKota.style.display = 'none';
                    });
            });

            // Event saat Kota dipilih (Untuk simpan ke hidden input jika perlu, atau pakai value langsung)
            selectKota.addEventListener('change', function() {
                inputKotaNama.value = this.value;
            });
        });
    </script>

@endsection
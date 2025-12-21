@extends('layouts.layout')

@section('title', 'Daftar Klub Baru - Swim Base')

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
        .welcome-text { margin-left: 100px; max-width: 500px; }
        .welcome-text h1 { font-size: 3rem; font-weight: 900; margin-bottom: 0.5rem; line-height: 1.2; }
        .welcome-text p { font-size: 1.25rem; color: #ddd; }

        /* Login Box Styling */
        .login-box {
            background-color: rgba(0, 0, 0, 0.65); /* Sedikit lebih gelap agar teks terbaca */
            padding: 2.5rem;
            border-radius: 16px;
            margin-right: 100px;
            width: 550px;
            max-height: 85vh; 
            overflow-y: auto; 
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            scrollbar-width: thin;
            scrollbar-color: #d22222 transparent;
        }

        /* Webkit Scrollbar */
        .login-box::-webkit-scrollbar { width: 6px; }
        .login-box::-webkit-scrollbar-thumb { background-color: #d22222; border-radius: 10px; }

        .login-box h2 { text-align: center; font-size: 1.8rem; margin-bottom: 2rem; color: #fff; font-weight: 700; }
        
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; }
        .form-row.full { grid-template-columns: 1fr; }
        
        .login-box label { display: block; font-weight: 500; margin-bottom: 0.5rem; color: #ccc; font-size: 0.9rem; }
        
        .input-icon { position: relative; width: 100%; margin-bottom: 0.5rem; }
        
        .input-icon input, 
        .input-icon select {
            width: 100%; height: 48px;
            padding-left: 15px; 
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            font-size: 15px;
            outline: none;
            transition: 0.3s;
        }

        .input-icon input:focus,
        .input-icon select:focus {
            border-color: #d22222;
            background: rgba(0, 0, 0, 0.4);
        }

        .input-icon select option { background-color: #222; color: white; }

        /* Khusus input password dengan icon */
        .with-icon input { padding-left: 48px; }
        .with-icon .icon {
            width: 22px; height: 22px; position: absolute;
            left: 14px; top: 50%; transform: translateY(-50%); opacity: 0.7;
        }

        .login-btn {
            width: 100%; padding: 1rem; border-radius: 8px; border: none;
            background-color: #d22222; color: white; font-weight: 700; font-size: 1.1rem;
            cursor: pointer; margin-top: 1.5rem; transition: 0.3s ease;
            box-shadow: 0 4px 15px rgba(210, 34, 34, 0.4);
        }
        .login-btn:hover { background-color: #b01c1c; transform: translateY(-2px); }

        .eye-btn {
            position: absolute; right: 15px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer; padding: 0; opacity: 0.7;
        }
        .eye-btn:hover { opacity: 1; }
        .eye-btn img { width: 22px; }

        .signup-text { text-align: center; font-size: 0.95rem; color: #bbb; margin-top: 1.5rem; }
        .signup-text a { color: #4ea1d3; font-weight: 600; text-decoration: none; }
        .signup-text a:hover { text-decoration: underline; color: #fff; }

        .error-msg { color: #ff6b6b; font-size: 0.8rem; margin-top: 2px; }

        .loading-text { position: absolute; right: 10px; top: 14px; font-size: 12px; color: #aaa; }

        @media (max-width: 900px) {
            .container { flex-direction: column; padding: 2rem; justify-content: center; overflow-y: auto; }
            .welcome-text { margin: 0; margin-bottom: 2rem; text-align: center; }
            .login-box { margin: 0; width: 100%; max-width: 400px; }
            .form-row { grid-template-columns: 1fr; gap: 0.5rem; }
        }
    </style>

    <div class="container">
        <div class="welcome-text">
            <h1>Bergabung dengan Swim Base!</h1>
            <p>Daftarkan klub renang Anda untuk mengelola atlet dan kompetisi dengan lebih profesional.</p>
        </div>

        <div class="login-box">
            <h2>Registrasi Klub</h2>

            {{-- UPDATE: Route ke club.register.process --}}
            <form action="{{ route('club.register.process') }}" method="POST">
                @csrf

                {{-- Row 1: Nama Klub --}}
                <div class="form-row full">
                    <div>
                        <label for="name">Nama Klub</label>
                        <div class="input-icon">
                            {{-- UPDATE: name="name" --}}
                            <input type="text" id="name" name="name" 
                                   placeholder="Masukkan nama resmi klub" 
                                   value="{{ old('name') }}" required>
                        </div>
                        @error('name') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Row 2: Wilayah (API) --}}
                <div class="form-row">
                    <div>
                        <label for="select_provinsi">Provinsi</label>
                        <div class="input-icon">
                            <select id="select_provinsi" required>
                                <option value="" disabled selected>Pilih Provinsi...</option>
                            </select>
                            
                            {{-- Hidden Input untuk kirim Nama Provinsi ke Controller --}}
                            {{-- UPDATE: name="province" --}}
                            <input type="hidden" id="province" name="province" value="{{ old('province') }}">
                        </div>
                        @error('province') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label for="city">Kabupaten/Kota</label>
                        <div class="input-icon">
                            {{-- UPDATE: name="city" --}}
                            <select id="city" name="city" required disabled>
                                <option value="" disabled selected>Pilih Provinsi dulu...</option>
                            </select>
                            <span id="loading-kota" class="loading-text" style="display:none;">Loading...</span>
                        </div>
                        @error('city') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Row 3: Alamat Detail --}}
                <div class="form-row full">
                    <div>
                        <label for="address">Detail Alamat</label>
                        <div class="input-icon">
                            {{-- UPDATE: name="address" --}}
                            <input type="text" id="address" name="address" 
                                   placeholder="Jalan, RT/RW, Kelurahan, Kecamatan" 
                                   value="{{ old('address') }}" required>
                        </div>
                        @error('address') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Row 4: Kontak & Email --}}
                <div class="form-row">
                    <div>
                        <label for="phone">Kontak Club (WA)</label>
                        <div class="input-icon">
                            {{-- UPDATE: name="phone" --}}
                            <input type="tel" id="phone" name="phone" 
                                   placeholder="Contoh: 0812xxxx" 
                                   value="{{ old('phone') }}" required>
                        </div>
                        @error('phone') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label for="email">Email Login</label>
                        <div class="input-icon">
                            {{-- UPDATE: name="email" --}}
                            <input type="email" id="email" name="email" 
                                   placeholder="email@club.com" 
                                   value="{{ old('email') }}" required>
                        </div>
                        @error('email') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Row 5: Password & Confirm --}}
                <div class="form-row full">
                    <div>
                        <label for="password">Password</label>
                        <div class="input-icon with-icon"> 
                            <input id="password-field" type="password" name="password" placeholder="Buat password minimal 6 karakter" required>
                            <button type="button" class="eye-btn" onclick="togglePassword('password-field', 'eye-icon-1')">
                                <img id="eye-icon-1" src="{{ asset('images/eye-icon.png') }}">
                            </button>
                        </div>
                        @error('password') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>
                
                {{-- Row 6: Konfirmasi Password --}}
                <div class="form-row full">
                    <div>
                        <label for="password_confirmation">Ulangi Password</label>
                        <div class="input-icon with-icon"> 
                            <input id="password-confirm-field" type="password" name="password_confirmation" placeholder="Ketik ulang password" required>
                            <button type="button" class="eye-btn" onclick="togglePassword('password-confirm-field', 'eye-icon-2')">
                                <img id="eye-icon-2" src="{{ asset('images/eye-icon.png') }}">
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="login-btn">Daftar Sekarang</button>

            </form>
            <div class="signup-text">
                Sudah punya akun? <a href="{{ route('club.login') }}">Login di sini</a>
            </div>
        </div>
    </div>

    <script>
        // 1. Logic Toggle Password (Universal)
        function togglePassword(fieldId, iconId) {
            const pass = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (pass.type === "password") {
                pass.type = "text";
                icon.style.opacity = "1";
            } else {
                pass.type = "password";
                icon.style.opacity = "0.7";
            }
        }

        // 2. Logic API Wilayah Indonesia
        document.addEventListener("DOMContentLoaded", function() {
            const selectProvinsi = document.getElementById('select_provinsi'); // Select User
            const inputProvinsi = document.getElementById('province');       // Hidden Input
            const selectKota = document.getElementById('city');              // Select Kota (name="city")
            const loadingKota = document.getElementById('loading-kota');

            const apiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api';

            // A. Fetch Provinsi
            fetch(`${apiBaseUrl}/provinces.json`)
                .then(response => response.json())
                .then(provinces => {
                    provinces.forEach(province => {
                        const option = document.createElement('option');
                        option.value = province.id; // Value ID untuk fetch kota
                        option.textContent = province.name; // Tampilan nama
                        option.setAttribute('data-name', province.name); // Simpan nama asli
                        selectProvinsi.appendChild(option);
                    });
                })
                .catch(err => console.error('Gagal memuat provinsi:', err));

            // B. Event Ganti Provinsi
            selectProvinsi.addEventListener('change', function() {
                const provinceId = this.value;
                const provinceName = this.options[this.selectedIndex].getAttribute('data-name');
                
                // Simpan NAMA provinsi ke hidden input agar dikirim ke Controller
                inputProvinsi.value = provinceName;

                // Reset Kota
                selectKota.innerHTML = '<option value="" disabled selected>Pilih Kota/Kabupaten...</option>';
                selectKota.disabled = true;
                loadingKota.style.display = 'block';

                // Fetch Kota
                fetch(`${apiBaseUrl}/regencies/${provinceId}.json`)
                    .then(response => response.json())
                    .then(regencies => {
                        regencies.forEach(regency => {
                            const option = document.createElement('option');
                            // PENTING: Value kita set NAMA KOTA agar Controller menerima string "KAB. WONOSOBO"
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
        });
    </script>

@endsection
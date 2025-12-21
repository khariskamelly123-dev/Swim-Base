@extends('layouts.layout')

@section('title', 'Register Institusi - Swim Base')

@section('content')

    <style>
        /* CSS SAMA SEPERTI SEBELUMNYA */
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
        .welcome-text h1 { font-size: 3rem; font-weight: 900; margin-bottom: 0.5rem; }
        .welcome-text p { font-size: 1.25rem; color: #ddd; }

        .login-box {
            background-color: rgba(0, 0, 0, 0.65); padding: 2.5rem; border-radius: 16px;
            margin-right: 100px; width: 550px; max-height: 85vh; overflow-y: auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5); backdrop-filter: blur(5px);
            scrollbar-width: thin; scrollbar-color: #d22222 transparent;
        }
        .login-box h2 { text-align: center; font-size: 1.8rem; margin-bottom: 2rem; color: #fff; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-row.full { grid-template-columns: 1fr; }
        .login-box label { display: block; font-weight: 500; margin-bottom: 0.5rem; color: #ccc; font-size: 0.9rem; }
        .input-icon { position: relative; width: 100%; margin-bottom: 0.5rem; }
        
        /* Styling Input & Select */
        .input-icon input, .input-icon select {
            width: 100%; height: 48px; padding-left: 15px; border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.3); background: rgba(255, 255, 255, 0.05);
            color: #fff; font-size: 15px; outline: none; transition: 0.3s;
        }
        .input-icon select option { background-color: #222; color: white; }
        .input-icon input:focus, .input-icon select:focus { border-color: #d22222; background: rgba(0, 0, 0, 0.4); }
        
        /* Icon styling */
        .with-icon input { padding-left: 48px; }
        .with-icon .icon {
            width: 22px; height: 22px; position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%); opacity: 0.7;
        }
        
        .login-btn {
            width: 100%; padding: 1rem; border-radius: 8px; border: none;
            background-color: #d22222; color: white; font-weight: 700; font-size: 1.1rem;
            cursor: pointer; margin-top: 1.5rem; transition: 0.3s ease;
        }
        .login-btn:hover { background-color: #b01c1c; transform: translateY(-2px); }
        
        .eye-btn {
            position: absolute; right: 15px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer; padding: 0; opacity: 0.7;
        }
        .signup-text { text-align: center; font-size: 0.95rem; color: #bbb; margin-top: 1.5rem; }
        .signup-text a { color: #4ea1d3; font-weight: 600; text-decoration: none; }
        .error-msg { color: #ff6b6b; font-size: 0.8rem; margin-top: 2px; }

        @media (max-width: 900px) {
            .container { flex-direction: column; text-align: center; padding: 2rem; }
            .welcome-text { margin: 0; margin-bottom: 2rem; }
            .login-box { margin: 0; width: 100%; max-width: 400px; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>

    <div class="container">
        <div class="welcome-text">
            <h1>Selamat Datang di Swim Base!</h1>
            <p>Daftarkan akun Sekolah atau Universitas Anda.</p>
        </div>

        <div class="login-box">
            <h2>Register Institusi</h2>

            <form action="{{ route('institution.register.process') }}" method="POST">
                @csrf

                <div class="form-row full">
                    <div>
                        <label for="type">Tipe Institusi</label>
                        <div class="input-icon">
                            <select id="type" name="type" required>
                                <option value="" disabled selected>Pilih Tipe...</option>
                                <option value="school" {{ old('type') == 'school' ? 'selected' : '' }}>Sekolah (SD/SMP/SMA/SMK)</option>
                                <option value="university" {{ old('type') == 'university' ? 'selected' : '' }}>Perguruan Tinggi (Universitas/Politeknik)</option>
                            </select>
                        </div>
                        @error('type') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-row full">
                    <div>
                        <label for="name">Nama Sekolah/Universitas</label>
                        <div class="input-icon">
                            <input type="text" id="name" name="name" 
                                   placeholder="Contoh: SMA Negeri 1 Wonosobo / UNSIQ"
                                   value="{{ old('name') }}" required>
                        </div>
                        @error('name') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-row full">
                    <div>
                        <label for="address">Alamat Lengkap</label>
                        <div class="input-icon">
                            <input type="text" id="address" name="address"
                                   placeholder="Jalan, Kota, Provinsi" 
                                   value="{{ old('address') }}" required>
                        </div>
                        @error('address') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label for="phone">Kontak (Telp/WA)</label>
                        <div class="input-icon">
                            <input type="tel" id="phone" name="phone" 
                                   placeholder="08xxxxx" 
                                   value="{{ old('phone') }}" required>
                        </div>
                        @error('phone') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label for="email">Email Resmi</label>
                        <div class="input-icon">
                            <input type="email" id="email" name="email" 
                                   placeholder="admin@sekolah.sch.id" 
                                   value="{{ old('email') }}" required>
                        </div>
                        @error('email') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-row full">
                    <div>
                        <label for="password">Password</label>
                        <div class="input-icon with-icon">
                            <input id="password-field" type="password" name="password" placeholder="Minimal 6 karakter" required>
                            <button type="button" class="eye-btn" onclick="togglePassword('password-field', 'eye-icon-1')">
                                <img id="eye-icon-1" src="{{ asset('images/eye-icon.png') }}">
                            </button>
                        </div>
                        @error('password') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

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

                <button type="submit" class="login-btn">Register</button>

            </form>
            <div class="signup-text">
                Sudah punya akun? <a href="{{ route('institution.login') }}">Login di sini</a>
            </div>

        </div>
    </div>

    <script>
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
    </script>

@endsection
@extends('layouts.layout')

@section('title', 'Login Sekolah/Universitas - Swim Base')

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
            height: calc(100% - 72px); padding: 0 4rem;
            position: relative; z-index: 1;
        }

        .welcome-text { margin-left: 100px; max-width: 500px; }
        .welcome-text h1 { font-size: 3rem; font-weight: 900; margin-bottom: 0.5rem; }
        .welcome-text p { font-size: 1.25rem; color: #ddd; }

        .login-box {
            background-color: rgba(0, 0, 0, 0.65);
            padding: 2.5rem;
            border-radius: 16px;
            margin-right: 150px;
            margin-top: 50px;
            width: 450px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .login-box label { display: block; font-weight: 600; margin-bottom: 0.25rem; color: #eee; }

        .input-icon { position: relative; width: 100%; margin-bottom: 0.5rem; }

        .input-icon .icon {
            width: 22px; height: 22px; position: absolute;
            left: 14px; top: 23px; transform: translateY(-50%); opacity: 0.8;
        }

        .input-icon input {
            width: 100%; height: 48px; padding-left: 48px; border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            background: rgba(255, 255, 255, 0.05);
            color: #fff; font-size: 15px; outline: none; transition: 0.3s;
        }

        .input-icon input:focus {
            border-color: #d22222;
            background: rgba(0, 0, 0, 0.4);
        }

        .input-icon input::placeholder { color: #ccc; }

        .options {
            display: flex; justify-content: space-between; font-size: 0.9rem;
            color: #ccc; margin-bottom: 1.5rem; margin-top: 1rem;
        }

        .login-btn {
            width: 100%; padding: 0.85rem; border-radius: 8px; border: none;
            background-color: #d22222; color: white; font-weight: 700;
            font-size: 1.1rem; cursor: pointer; margin-bottom: 1rem;
            transition: 0.3s ease;
        }
        .login-btn:hover { background-color: #b01c1c; transform: translateY(-2px); }

        .eye-btn {
            position: absolute; right: 12px; top: 23px; transform: translateY(-50%);
            background: none; border: none; cursor: pointer; padding: 0; opacity: 0.7;
        }
        .eye-btn img { width: 22px; }

        .signup-text { text-align: center; font-size: 0.9rem; color: #ccc; margin-top: 1rem; }
        .signup-text a { color: #4ea1d3; font-weight: 600; text-decoration: none; }
        .signup-text a:hover { text-decoration: underline; color: #fff; }

        .error-msg {
            color: #ff6b6b; font-size: 0.85rem; margin-top: 5px; margin-bottom: 10px;
        }

        @media (max-width: 900px) {
            .container { flex-direction: column; text-align: center; padding: 2rem; }
            .welcome-text { margin: 0; margin-bottom: 2rem; }
            .login-box { margin: 0; width: 90%; max-width: 400px; }
        }
    </style>

    <div class="container">
        <div class="welcome-text">
            <h1>Selamat Datang di Swim Base!</h1>
            <p>Silakan login ke akun Sekolah atau Universitas Anda.</p>
        </div>

        <div class="login-box">

            @include('partials.flash_messages')

            {{-- UPDATE: Route ke institution.login.process --}}
            <form action="{{ route('institution.login.process') }}" method="POST">
                @csrf

                <label for="email">Email</label>
                <div class="input-icon">
                    <img src="{{ asset('images/email-icon.png') }}" class="icon">
                    
                    {{-- UPDATE: name="email" --}}
                    <input type="email" name="email" id="email" 
                           placeholder="admin@sekolah.sch.id" 
                           value="{{ old('email') }}" required autofocus>
                </div>
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror

                <label for="password">Password</label>
                <div class="input-icon">
                    <img src="{{ asset('images/lock-icon.png') }}" class="icon">
                    
                    <input id="password-field" type="password" name="password" 
                           placeholder="Masukkan password Anda" required>

                    <button type="button" class="eye-btn" onclick="togglePassword()">
                        <img id="eye-icon" src="{{ asset('images/eye-icon.png') }}">
                    </button>
                </div>
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror

                <div class="options">
                    <label><input type="checkbox" name="remember"> Ingat Saya</label>
                    <a href="#" style="color:#2f98f4;">Lupa Password?</a>
                </div>

                <button type="submit" class="login-btn">Masuk</button>
            </form>

            <div class="signup-text">
                {{-- UPDATE: Route ke institution.register --}}
                Belum punya akun? <a href="{{ route('institution.register') }}">Daftar di sini</a>
            </div>

        </div>
    </div>

    <script>
        function togglePassword() {
            const pass = document.getElementById("password-field");
            const icon = document.getElementById("eye-icon");

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
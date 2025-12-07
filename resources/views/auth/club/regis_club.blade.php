@extends('layouts.layout')

@section('title', 'Register Club - Swim Base')

@section('content')

    <style>
        * {
            box-sizing: border-box;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Roboto', sans-serif;
            color: white;
            background: url('/images/bg-swim.jpg') no-repeat center center fixed;
            background-size: cover;
            overflow: hidden;
            position: relative;
        }

        nav {
            background-color: #000000;
            padding: 1rem 2rem;
            z-index: 10;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: calc(100% - 72px);
            padding: 0 4rem;
            position: relative;
            z-index: 1;
        }

        .welcome-text {
            margin-left: 100px;
        }

        .welcome-text h1 {
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
        }

        .welcome-text p {
            font-size: 1.25rem;
            color: #ddd;
        }

        .login-box {
            background-color: rgba(0, 0, 0, 0.55);
            padding: 2rem;
            border-radius: 16px;
            margin-right: 150px;
            margin-top: 0px;
            width: 500px;
            max-height: 85vh;
            overflow-y: auto;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .login-box h2 {
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: #fff;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-row.full {
            grid-template-columns: 1fr;
        }

        .login-box label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: #eee;
        }

        .input-icon {
            position: relative;
            width: 100%;
        }

        .input-icon .icon {
            width: 22px;
            height: 22px;
            position: absolute;
            left: 14px;
            top: 23px;
            transform: translateY(-50%);
            opacity: 0.9;
        }

        .input-icon input {
            width: 100%;
            height: 45px;
            padding-left: 48px;
            border-radius: 8px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            background: transparent;
            color: #fff;
            font-size: 15px;
            outline: none;
            margin-bottom: 1rem;
        }

        .input-icon input::placeholder {
            color: #cfcfcf;
        }

        /* LOGIN BUTTON */
        .login-btn {
            width: 100%;
            padding: 0.75rem;
            border-radius: 8px;
            border: none;
            background-color: white;
            color: black;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            margin-bottom: 1rem;
            transition: 0.3s ease;
        }

        .login-btn:hover {
            background-color: #d22222;
            color: white;
        }

        .eye-btn {
            position: absolute;
            right: 12px;
            top: 23px;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .eye-btn img {
            width: 22px;
            opacity: 0.9;
        }

        .signup-text {
            text-align: center;
            font-size: 0.9rem;
            color: #ccc;
            margin-top: 1rem;
        }

        .signup-text a {
            color: #4ea1d3;
            font-weight: 600;
            text-decoration: none;
        }

        .signup-text a:hover {
            text-decoration: underline;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .container {
                flex-direction: column;
                text-align: center;
                padding: 2rem;
            }

            .welcome-text {
                margin: 0;
                margin-bottom: 2rem;
            }

            .login-box {
                margin: 0;
                width: 90%;
                max-width: 360px;
            }
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

                <!-- NAMA KLUB -->
                <div class="form-row full">
                    <div>
                        <label for="nama_klub">Nama Klub</label>
                        <div class="input-icon">
                            <input type="text" id="nama_klub" name="nama_klub" placeholder="Masukkan nama klub" required>
                        </div>
                    </div>
                </div>

                <!-- ALAMAT KLUB -->
                <div class="form-row full">
                    <div>
                        <label for="alamat_klub">Alamat Klub</label>
                        <div class="input-icon">
                            <input type="text" id="alamat_klub" name="alamat_klub" placeholder="Masukkan alamat klub"
                                required>
                        </div>
                    </div>
                </div>

                <!-- KONTAK CLUB -->
                <div class="form-row">
                    <div>
                        <label for="kontak_club">Kontak Club</label>
                        <div class="input-icon">
                            <input type="tel" id="kontak_club" name="kontak_club" placeholder="Nomor telepon" required>
                        </div>
                    </div>

                    <!-- EMAIL RESMI CLUB -->
                    <div>
                        <label for="email_resmi">Email Resmi Club</label>
                        <div class="input-icon">
                            <input type="email" id="email_resmi" name="email_resmi" placeholder="email@club.com" required>
                        </div>
                    </div>
                </div>

                <!-- PELATIH -->
                <div class="form-row full">
                    <div>
                        <label for="pelatih">Nama Pelatih</label>
                        <div class="input-icon">
                            <input type="text" id="pelatih" name="pelatih" placeholder="Masukkan nama pelatih" required>
                        </div>
                    </div>
                </div>

                <!-- PASSWORD -->
                <div class="form-row full">
                    <div>
                        <label for="password">Password</label>
                        <div class="input-icon">
                            <input id="password-field" type="password" name="password" placeholder="Masukkan password"
                                required>
                            <button type="button" class="eye-btn" onclick="togglePassword()">
                                <img id="eye-icon" src="{{ asset('images/eye-icon.png') }}">
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="login-btn">Register</button>

            </form>
            <div class="signup-text">
                Sudah punya akun? <a href="{{ route('club_login') }}">Login di sini</a>
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
                icon.style.opacity = "0.8";
            }
        }
    </script>

@endsection
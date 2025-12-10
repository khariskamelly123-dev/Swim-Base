@extends('layouts.layout')

@section('title', 'Login - Swim Base')

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
            margin-top: 50px;
            width: 400px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
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

        /* OPTIONS */
        .options {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: #ccc;
            margin-bottom: 1rem;
        }

        .options label {
            display: flex;
            align-items: center;
            gap: 0.3rem;
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

        /* SEPARATOR */
        .separator {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            color: #bbb;
            margin-bottom: 1rem;
        }

        .separator::before,
        .separator::after {
            content: "";
            flex-grow: 1;
            height: 1px;
            background: #444;
            margin: 0 0.75rem;
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
            <p>Please log in using the form below</p>
        </div>

        <div class="login-box">

            @include('partials.flash_messages')

            <form action="{{ route('sekouniv.login.process') }}" method="POST">
                @csrf

                <!-- email -->
                <label for="email_resmi_seko_univ">Email</label>
                <div class="input-icon">
                    <img src="{{ asset('images/email.png') }}" class="icon">
                    <input type="email" name="email_resmi_seko_univ" placeholder="schuniv@gmail.com">
                </div>

                <!-- PASSWORD -->
                <label for="password">Password</label>
                <div class="input-icon">
                    <img src="{{ asset('images/lock-icon.png') }}" class="icon">
                    <input id="password-field" type="password" name="password" placeholder="password">

                    <!-- icon mata -->
                    <button type="button" class="eye-btn" onclick="togglePassword()">
                        <img id="eye-icon" src="{{ asset('images/eye-icon.png') }}">
                    </button>
                </div>


                <div class="options">
                    <label><input type="checkbox"> Remember me</label>
                    <a href="#" style="color:#2f98f4;">Forgot Password?</a>
                </div>

                <button type="submit" class="login-btn">Log in</button>
            </form>
            <div class="signup-text">
                Belum punya akun? <a href="{{ route('sekouniv_register') }}">Daftar di sini</a>
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
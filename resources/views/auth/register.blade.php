@extends('layouts.layout')

@section('title', 'Register - Swim Base')

@section('content')

    <style>
        * {
            box-sizing: border-box;
        }

        .page-bg {
            background: url('/images/bg-swim.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px 0;
        }


        .container-auth {
            background: rgba(0, 0, 0, 0.7);
            max-width: 400px;
            width: 90%;
            padding: 20px 18px;
            border-radius: 12px;
            color: white;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
        }

        .input-group {
            position: relative;
            margin-bottom: 18px;
        }

        .input-group img.icon {
            width: 20px;
            height: 20px;
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.85;
        }

        .input-group input {
            width: 100%;
            height: 42px;
            padding-left: 45px;
            border-radius: 8px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.5);
            color: white;
            font-size: 14px;
            outline: none;
        }

        .input-group input::placeholder {
            color: rgba(255, 255, 255, 0.8);
        }

        .eye-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .eye-btn img {
            width: 20px;
            height: 20px;
            opacity: 0.75;
        }

        .remember {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-bottom: 18px;
        }

        .btn-primary {
            width: 100%;
            padding: 10px 0;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            background: white;
            color: black;
            margin-bottom: 16px;
        }

        .divider {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
        }

        .divider hr {
            flex-grow: 1;
            border: none;
            border-top: 1px solid gray;
        }

        .divider span {
            margin: 0 10px;
            color: #cfcfcf;
        }

        .btn-google {
            width: 100%;
            padding: 10px 0;
            border-radius: 6px;
            border: none;
            background: white;
            color: black;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .btn-google img {
            width: 20px;
            height: 20px;
        }

        .signup-text {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
            color: #cccccc;
        }

        .signup-text a {
            color: #4da6ff;
            text-decoration: none;
        }
    </style>

    <div class="page-bg">
        <div class="container-auth">

            <form>

                <label>Nama</label>
                <div class="input-group">
                    <img src="/images/person-icon.png" class="icon">
                    <input type="text" placeholder="Nama Anda">
                </div>

                <label>Email</label>
                <div class="input-group">
                    <img src="/images/email-icon.png" class="icon">
                    <input type="email" placeholder="email@example.com">
                </div>

                <label>Password</label>
                <div class="input-group">
                    <img src="/images/lock-icon.png" class="icon">
                    <input type="password" placeholder="password">
                    <button type="button" class="eye-btn">
                        <img src="/images/eye-icon.png">
                    </button>
                </div>

                <div class="remember">
                    <label><input type="checkbox"> Remember me</label>
                    <a href="#" style="color:#4da6ff;">Forgot Password?</a>
                </div>

                <button class="btn-primary">Log in</button>

                <div class="divider">
                    <hr><span>Or</span>
                    <hr>
                </div>

                <button class="btn-google">
                    <img src="/images/google-icon.png"> Continue with Google
                </button>

                <p class="signup-text">
                    Don't have an account?
                    <a href="#">Sign Up</a>
                </p>

            </form>
        </div>
@endsection
</div>
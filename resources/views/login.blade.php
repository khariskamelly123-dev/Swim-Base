 @extends('layouts.layout')
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Swim Base Login</title>
    

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

        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.65);
            z-index: 0;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            position: relative;
            z-index: 1;
            background-color: #000000;
            /* WARNA HITAM NAVBAR */
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: calc(100% - 72px) padding: 0 4rem;
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
            background-color: rgba(0, 0, 0, 0.4);
            padding: 2rem;
            border-radius: 16px;
            margin-right: 150px;
            margin-button: 100px;
            margin-top: 100px;
            width: 400px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .login-box label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: #eee;
        }

        .login-box input[type="email"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 0.7rem 1rem;
            margin-bottom: 1rem;
            background: transparent !important;
            border: 2px solid rgba(255, 255, 255, 0.5) !important;
            border-radius: 8px;
            color: #fff !important;
            outline: none;
            box-shadow: none !important;
        }

        .input-icon {
            position: relative;
            width: 100%;
        }

        .input-icon .icon {
            width: 20px;
            height: 20px;
            position: absolute;
            left: 12px;
            top: 35%;
            transform: translateY(-50%);
            opacity: 0.85;
        }

        .input-icon input {
            width: 100%;
            padding: 0.7rem 1rem;
            padding-left: 50px;
            margin-bottom: 1rem;
            background: transparent !important;
            border: 2px solid rgba(255, 255, 255, 0.5) !important;
            border-radius: 8px;
            color: #fff !important;
            outline: none;
        }

        .input-icon input::placeholder {
            padding-left: 20px;
        }


        .login-box input::placeholder {
            color: #888;
        }

        .password-container {
            position: relative;
        }

        .login-box .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: #ccc;
        }

        .login-box .options label {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            cursor: pointer;
            user-select: none;
        }

        .login-box button.login-btn {
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
            transition: background-color 0.3s ease;
        }

        .login-box button.login-btn:hover {
            background-color: #d22222;
        }

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

        .google-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.75rem;
            border-radius: 8px;
            border: none;
            background-color: white;
            color: black;
            font-weight: 600;
            cursor: pointer;
            gap: 8px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .google-logo {
            width: 20px;
            height: auto;
        }


        .google-btn:hover {
            background-color: #eee;
        }

        .signup-text {
            text-align: center;
            font-size: 0.9rem;
            color: #ccc;
            margin-top: 1rem;
        }

        .signup-text a {
            color: #4ea1d3;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
        }

        .signup-text a:hover {
            text-decoration: underline;
        }

        @media (max-width: 900px) {
            .container {
                flex-direction: column;
                justify-content: center;
                padding: 2rem;
            }

            .welcome-text {
                max-width: 100%;
                margin-bottom: 2rem;
                text-align: center;
            }

            .login-box {
                width: 100%;
                max-width: 360px;
            }

            ul.nav-links {
                gap: 1rem;
            }

            .search-container input[type="search"] {
                width: 120px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="welcome-text">
            <h1>Welcome to Swim Base!</h1>
            <p>Please log in using the from below</p>
        </div>

        <div class="login-box">
            <form>
                <label for="email">Email</label>
                <div class="input-icon">
                    <img src="{{ asset('images/person-icon.png') }}" class="icon">
                    <input type="email" id="email" placeholder="contoh@gmail.com" required />
                </div>


                <label for="password">Password</label>
                <div class="input-icon">
                    <img src="{{ asset('images/lock-icon.png') }}" class="icon">
                    <input type="password" id="password" placeholder="password" required />
                </div>


                <div class="options">
                    <label><input type="checkbox" /> Remember me</label>
                    <a href="#" style="color:#aaa; text-decoration:none;">Forgot Password?</a>
                </div>

                <button type="submit" class="login-btn">Log in</button>
            </form>

            <div class="separator">Or</div>

            <button class="google-btn" type="button">
                <img src="{{ asset('images/google-icon.png') }}" class="google-logo" alt="Google logo" />
                Continue with Google
            </button>

            <div class="signup-text">
                Don't have account? <a href="#">Sign Up</a>
            </div>
        </div>
    </div>
</body>

</html>
@endsection

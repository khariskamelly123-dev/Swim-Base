@extends('layouts.layout')

@section('title', 'Login - Swim Base')

@section('content')

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Swim Base Login</title>

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

            .login-box h2 {
                text-align: center;
                font-size: 1.5rem;
                margin-bottom: 1.5rem;
                color: #fff;
            }

            .selection-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
            }

            .selection-card {
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
                border: 2px solid rgba(255, 255, 255, 0.3);
                border-radius: 12px;
                padding: 1.5rem;
                text-align: center;
                cursor: pointer;
                transition: all 0.3s ease;
                text-decoration: none;
                color: inherit;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 0.75rem;
                min-height: 150px;
            }

            .selection-card:hover {
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
                border-color: rgba(255, 255, 255, 0.6);
                transform: translateY(-5px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            }

            .selection-card .icon {
                font-size: 3rem;
                line-height: 1;
            }

            .selection-card h3 {
                font-size: 1.1rem;
                font-weight: 600;
                margin: 0;
                color: #fff;
            }

            .selection-card p {
                font-size: 0.85rem;
                color: #ddd;
                margin: 0;
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
    </head>

    <body>

        <div class="container">
            <div class="welcome-text">
                <h1>Welcome to Swim Base!</h1>
            </div>

            <div class="login-box">
                <h2>LOGIN AS</h2>

                <div class="selection-grid">
                    <a href='login' class="selection-card">
                        <span class="icon">🎓</span>
                        <h3>School / University</h3>
                        <p>Student Account</p>
                    </a>

                    <a href="club_login" class="selection-card">
                        <span class="icon">🏊</span>
                        <h3>Club</h3>
                        <p>Club Member</p>
                    </a>

                    <a href="admin_login" class="selection-card">
                        <span class="icon">👤</span>
                        <h3>Admin</h3>
                        <p>Administrator</p>
                    </a>

                    <a href="superadmin_login" class="selection-card">
                        <span class="icon">👑</span>
                        <h3>Super Admin</h3>
                        <p>System Administrator</p>
                    </a>
                </div>
            </div>
        </div>

        <script>
            // Selection cards already styled with hover effects
        </script>
    </body>
        <div style="position:fixed; left:20px; top:20px; background:#2c3e50; color:#ffffff; border-radius:8px; margin:0; padding:15px; line-height:1.6; z-index:10000; font-family:monospace; font-size:14px; box-shadow:0 4px 12px rgba(0,0,0,0.2); border-left:4px solid #3498db; max-width:320px;">
            <div style="color:#3498db; font-weight:bold; margin-bottom:8px; border-bottom:1px solid #4a6491; padding-bottom:5px;">SEKOLAH</div>
            <div>email: sekolah5@example.com</div>
            <div>pw: password</div>
            
            <div style="margin-top:12px; color:#3498db; font-weight:bold; margin-bottom:8px; border-bottom:1px solid #4a6491; padding-bottom:5px;">CLUB</div>
            <div>nama: klub5</div>
            <div>email: club5@example.com</div>
            <div>pw: password</div>
            
            <div style="margin-top:12px; color:#3498db; font-weight:bold; margin-bottom:8px; border-bottom:1px solid #4a6491; padding-bottom:5px;">ADMIN</div>
            <div>email: admin@example.com</div>
            <div>pw: password</div>
            
            <div style="margin-top:12px; color:#3498db; font-weight:bold; margin-bottom:8px; border-bottom:1px solid #4a6491; padding-bottom:5px;">SUPER ADMIN</div>
            <div>email: superadmin@example.com</div>
            <div>pw: adminsuper</div>
        </div>

    </body>

    </html>

@endsection
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Swim Base')</title>

    {{-- CSS GLOBAL --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        /* ====== NAVBAR ====== */
        nav {
            background: #000;
            color: white;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 30px;
            margin: 0;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            opacity: 0.85;
        }

        nav ul li a:hover {
            opacity: 1;
        }

        .active-link {
            color: #D92323 !important;
            border-bottom: 2px solid #D92323;
            padding-bottom: 3px;
        }

        .search-container {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-icon {
             color: white;
             font-size: 18px;
        }

        .search-box {
            background: transparent;
            border: none;
            border-bottom: 1px solid #666;
            padding: 6px 0;
            color: white;
            width: 200px;
            outline: none;
        }

        .search-box::placeholder {
            color: white;
            opacity: 0.7;
        }


        /* ====== CONTENT ====== */
        .content {
            padding: 40px;
            min-height: 70vh;
        }

        /* ====== FOOTER ====== */
        footer {
            background-image: url('/images/footer-bg.jpg'); 
            background-size: cover;
            background-position: center;
            padding: 25px 0;
            color: #fff;
            font-size: 18px;
            text-align: center;
            font-weight: 500;
            text-shadow: 0 0 5px rgba(0,0,0,0.8);
            margin-top: 30px;
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav>
            <div style="display:flex; align-items:center; gap:10px;">
        <img src="{{ asset('images/logo.png') }}" style="height:40px;">
        <span style="font-size:20px; font-weight:600;">Swim Base</span>
    </div>
    
        <ul>
            <li><a href="/" class="{{ Request::is('/') ? 'active-link' : '' }}">Beranda</a></li>
            <li><a href="/atlet" class="{{ Request::is('atlet') ? 'active-link' : '' }}">Atlet</a></li>
            <li><a href="/statistik" class="{{ Request::is('statistik') ? 'active-link' : '' }}">Statistik</a></li>
            <li><a href="/galeri" class="{{ Request::is('galeri') ? 'active-link' : '' }}">Galeri</a></li>
            <li><a href="/prestasi" class="{{ Request::is('prestasi') ? 'active-link' : '' }}">Prestasi</a></li>
            <li><a href="/login" class="{{ Request::is('login') ? 'active-link' : '' }}">Login</a></li>
        </ul>

        <div style="display: flex; align-items:center; gap:10px;">
            <img src="{{ asset('images/search-icon.png') }}" style="height:18px;">
            <input type="search" placeholder="Search" class="search-box">
        </div>
    </nav>

    {{-- KONTEN --}}
    <div class="content">
        @yield('content')
    </div>

    {{-- FOOTER --}}
    <footer>
        Copyright © {{ date('Y') }} Swim Base. All Rights Reserved
    </footer>

    {{-- JS GLOBAL --}}
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>

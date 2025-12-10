<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    {{-- HEADER HITAM --}}
    <nav style="background:black; padding:15px 40px; display:flex; justify-content:space-between; align-items:center;">
        <div style="display:flex; align-items:center; gap:10px;">
            <img src="{{ asset('images/logo.png') }}" style="height:40px;">
            <span style="color:white; font-size:20px; font-weight:600;">Swim Base</span>
        </div>

        <div style="display:flex; align-items:center; gap:10px; color:white;">
            <img src="{{ asset('images/search-icon.png') }}" style="height:18px;">
            <input type="search" placeholder="Search" class="search-box"
               style="background:transparent; border:none; border-bottom:1px solid #666; padding:6px 0; color:white;">
        </div>
    </nav>

    {{-- SIDEBAR --}}
    @include('components.sidebar')

    {{-- KONTEN DASHBOARD --}}
    <div style="margin-left:250px; padding:30px;">
        @yield('content')
    </div>

</body>

</html>

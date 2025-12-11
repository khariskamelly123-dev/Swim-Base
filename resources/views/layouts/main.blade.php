<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SwimBase</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            background: #e9ecef;
            font-family: Arial, sans-serif;
        }

        /* HEADER */
        #header {
            width: 100%;
            height: 70px;
            background: black;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        /* SIDEBAR */
        #sidebar {
            width: 250px;
            background: #f8f9fa;
            height: 100vh;
            border-right: 1px solid #ddd;
            padding-top: 100px;
            position: fixed;
            top: 0;
            left: 0;
        }

        .menu-item {
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
        }

        .menu-item a {
            text-decoration: none;
            color: #333;
            width: 100%;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .menu-item:hover {
            background: #e9ecef;
        }

        .menu-icon {
            width: 18px;
        }

        /* CONTENT */
        #content {
            margin-left: 250px;
            margin-top: 80px;
            padding: 20px;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div id="header">

        <!-- Logo -->
        <div class="d-flex align-items-center">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/PRSI_logo.png/120px-PRSI_logo.png"
                alt="Logo" height="45" style="margin-right:10px;">
            <span style="font-size:22px;font-weight:bold;color:#ff3b3b;">
                Swim<br>Base
            </span>
        </div>

        <!-- Search -->
        <div style="display: flex; align-items:center; gap:10px;">
            <img src="{{ asset('images/search-icon.png') }}" style="height:18px;">
            <input type="search" placeholder="Search" class="search-box">
        </div>

    </div>


    <!-- SIDEBAR -->
    <div id="sidebar">

        <!-- Foto User -->
        <div class="text-center mb-3">
            <img src="https://i.pravatar.cc/100" class="rounded-circle" width="80">
            <div class="mt-2 fw-semibold">{{ auth()->user()->name }}</div>
            <small class="text-muted">{{ auth()->user()->role }}</small>
        </div>

        {{-- Load sidebar sesuai role --}}
        @if(auth()->user()->role == 'superadmin')
            @include('layouts.sidebar.superadmin')
        @elseif(auth()->user()->role == 'admin')
            @include('layouts.sidebar.admin')
        @elseif(auth()->user()->role == 'club')
            @include('layouts.sidebar.club')
        @elseif(auth()->user()->role == 'sekolah')
            @include('layouts.sidebar.sekolah')
        @endif

    </div>


    <!-- MAIN CONTENT -->
    <div id="content">
        @yield('content')
    </div>

</body>

</html>
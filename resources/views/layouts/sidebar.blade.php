<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sidebar Layout</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            background: #e9ecef;
        }

        /* Header Hitam */
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

        /* Sidebar */
        #sidebar {
            width: 250px;
            background: #f8f9fa;
            height: 100vh;
            border-right: 1px solid #ddd;
            padding-top: 100px; /* supaya tidak ketutup header */
            position: fixed;
            top: 0;
            left: 0;
        }

        #sidebar .menu-item {
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        #sidebar .menu-item:hover {
            background: #e9ecef;
        }

        .menu-icon {
            width: 18px;
        }

        /* Konten Kosong */
        #content {
            margin-left: 250px;
            margin-top: 70px;
            padding: 20px;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div id="header">
        <div class="d-flex align-items-center gap-2">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/PRSI_logo.png/120px-PRSI_logo.png"
                 alt="Logo" height="45">
            <span class="fs-4 fw-bold text-white">Swim Base</span>
        </div>

        <div class="text-end text-white">
            🔍 Search
        </div>
    </div>

    <!-- SIDEBAR -->
    <div id="sidebar">

        <!-- Foto User -->
        <div class="text-center mb-3">
            <img src="https://i.pravatar.cc/100"
                 class="rounded-circle" width="80">
            <div class="mt-2 fw-semibold">User</div>
        </div>

        <!-- MENU -->
        <div class="menu-item">
            <span class="menu-icon">▦</span> Dashboard
        </div>
        <div class="menu-item">
            <span class="menu-icon">👤</span> Profil
        </div>
        <div class="menu-item">
            <span class="menu-icon">📄</span> Manajemen Klub
        </div>
        <div class="menu-item">
            <span class="menu-icon">🏫</span> Manajemen Sekolah
        </div>
        <div class="menu-item">
            <span class="menu-icon">🏊</span> Manajemen Atlet
        </div>
        <div class="menu-item">
            <span class="menu-icon">🗓</span> Manajemen Event
        </div>
        <div class="menu-item">
            <span class="menu-icon">📝</span> Input Hasil & Rekor
        </div>
        <div class="menu-item">
            <span class="menu-icon">📚</span> Manajemen Kategori
        </div>
        <div class="menu-item">
            <span class="menu-icon">⚙</span> Manajemen Akun User
        </div>

    </div>

    <!-- KONTEN KOSONG - backend akan isi -->
    <div id="content">
        <!-- Kosong -->
    </div>

</body>
</html>

@extends('layouts.layout') {{-- Pastikan ini sesuai dengan nama layout utama Anda --}}

@section('content')

    <style>
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%; /* Membuat gambar bulat */
            border: 5px solid #f0f0f0;
            margin-bottom: 20px;
        }
        .card-profile {
            max-width: 600px;
            margin: 0 auto; /* Tengah layar */
        }
    </style>

    <div class="container mt-5">
        <h1 class="mb-4 text-center text-white">Profil Pengguna</h1>

        {{-- ========================================================= --}}
        {{-- LOGIKA 1: JIKA YANG LOGIN ADALAH KLUB (Guard: club)       --}}
        {{-- ========================================================= --}}
        @if(Auth::guard('club')->check())
            @php $club = Auth::guard('club')->user(); @endphp
            
            <div class="card shadow card-profile">
                <div class="card-body text-center">
                    {{-- Gambar Placeholder (Inisial Nama Klub) --}}
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($club->nama_klub) }}&background=random&size=150" 
                         alt="Foto Profil" class="profile-img shadow-sm">
                    
                    <h3>{{ $club->nama_klub }}</h3>
                    <span class="badge bg-primary mb-3">Akun Klub</span>

                    <div class="text-start mt-4 px-4">
                        <p><strong>Email Resmi:</strong> <br> {{ $club->email_resmi }}</p>
                        <p><strong>Kontak (WA):</strong> <br> {{ $club->kontak_club }}</p>
                        <p><strong>Alamat:</strong> <br> {{ $club->alamat_klub }}</p>
                    </div>

                    <a href="#" class="btn btn-warning mt-3 w-100">Edit Profil Klub</a>
                </div>
            </div>
        @endif


        {{-- ========================================================= --}}
        {{-- LOGIKA 2: JIKA YANG LOGIN ADALAH USER BIASA (Guard: web)  --}}
        {{-- (Atlet, Admin, Superadmin ada di tabel users biasa)      --}}
        {{-- ========================================================= --}}
        @if(Auth::guard('web')->check())
            @php $user = Auth::user(); @endphp

            <div class="card shadow card-profile">
                <div class="card-body text-center">
                    {{-- Gambar Placeholder (Inisial Nama User) --}}
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=150" 
                         alt="Foto Profil" class="profile-img shadow-sm">
                    
                    <h3>{{ $user->name }}</h3>
                    
                    {{-- Badge Role --}}
                    @if($user->role == 'atlet')
                        <span class="badge bg-success mb-3">Atlet Renang</span>
                    @elseif($user->role == 'admin')
                        <span class="badge bg-info mb-3">Admin Verifikator</span>
                    @elseif($user->role == 'superadmin')
                        <span class="badge bg-danger mb-3">Super Admin</span>
                    @endif

                    <div class="text-start mt-4 px-4">
                        <p><strong>Email:</strong> <br> {{ $user->email }}</p>
                        
                        {{-- Tampilkan detail khusus Atlet --}}
                        @if($user->role == 'atlet')
                            {{-- Contoh jika ada kolom lain di tabel users, misal 'umur' atau 'jenis_kelamin' --}}
                            {{-- <p><strong>Umur:</strong> <br> {{ $user->umur ?? '-' }} Tahun</p> --}}
                            <p class="text-muted small">Detail atlet lainnya dapat ditambahkan di sini.</p>
                        @endif

                        {{-- Tampilkan detail khusus Admin --}}
                        @if($user->role == 'admin' || $user->role == 'superadmin')
                            <p><strong>Status:</strong> <br> Staff Aktif</p>
                        @endif
                    </div>

                    <a href="#" class="btn btn-primary mt-3 w-100">Edit Profil</a>
                </div>
            </div>
        @endif

    </div>
@endsection
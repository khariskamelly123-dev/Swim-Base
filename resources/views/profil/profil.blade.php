@extends('layouts.app')

@section('content')
    <div class="container">

        <h1 class="mb-4">Profil Pengguna</h1>

        {{-- -atlet --}}
        @if(Auth::user()->role == 'atlet')
            <div class="card shadow">
                <div class="card-body text-center">
                    <img src=>
                    <h3>Profil Atlet</h3>

                    <p><b>Nama:</b> Atlet Dummy</p>
                    <p><b>Cabang:</b> Renang</p>
                    <p><b>Umur:</b> 17 Tahun</p>

                    <a href="#" class="btn btn-primary mt-3">Edit Profil</a>
                </div>
            </div>
        @endif


        {{-- klub --}}
        @if(Auth::user()->role == 'klub')
            <div class="card shadow">
                <div class="card-body text-center">
                    <img src=>
                    <h3>Profil Klub / Sekolah</h3>

                    <p><b>Nama Klub:</b> Klub Renang Berlian</p>
                    <p><b>Alamat:</b> Jakarta</p>
                    <p><b>Pelatih:</b> Coach Dummy</p>

                    <a href="#" class="btn btn-primary mt-3">Edit Profil</a>
                </div>
            </div>
        @endif


        {{-- admin --}}
        @if(Auth::user()->role == 'admin')
            <div class="card shadow">
                <div class="card-body text-center">
                    <img src=>
                    <h3>Profil Admin</h3>

                    <p><b>Nama Admin:</b> Admin Dummy</p>
                    <p><b>Bagian:</b> Verifikasi Data</p>

                    <a href="#" class="btn btn-primary mt-3">Edit Profil</a>
                </div>
            </div>
        @endif


        {{-- superadmin --}}
        @if(Auth::user()->role == 'superadmin')
            <div class="card shadow">
                <div class="card-body text-center">
                    <img src=>
                    <h3>Profil Super Admin</h3>

                    <p><b>Nama:</b> Super Admin Dummy</p>
                    <p><b>Kewenangan:</b> Full Access</p>

                    <a href="#" class="btn btn-primary mt-3">Edit Profil</a>
                </div>
            </div>
        @endif

    </div>
@endsection
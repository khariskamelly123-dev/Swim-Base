@extends('layouts.layout')

@section('title', 'Create kategori - Swim Base')

@section('content')

        {{-- Sidebar --}}
        @include('layouts.sidebar.admin')

        {{-- Header --}}
        @include('layouts.header', [
    'title' => 'Create Kategori',
])

        <style>
            .content-wrapper {
                padding: 30px;
                background-color: #f4f6f8;
                min-height: 100vh;
            }

            /* ===== CARD ===== */
            .card {
                background: #ffffff;
                border-radius: 10px;
                padding: 30px;
                max-width: 900px;
            }

            .card h2 {
                font-size: 26px;
                font-weight: 700;
                margin-bottom: 25px;
                position: relative;
            }

            .card h2::after {
                content: '';
                position: absolute;
                left: 0;
                bottom: -8px;
                width: 70px;
                height: 3px;
                background-color: #e63946;
                border-radius: 10px;
            }

            /* ===== FORM ===== */
            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                display: block;
                font-weight: 600;
                margin-bottom: 8px;
            }

            .form-group input {
                width: 100%;
                padding: 12px 14px;
                border-radius: 8px;
                border: none;
                background-color: #e5e5e5;
                font-size: 14px;
            }

            .form-group input:focus {
                outline: none;
                background-color: #dedede;
            }

            /* ===== BUTTON ===== */
            .btn-wrapper {
                display: flex;
                justify-content: flex-end;
                margin-top: 30px;
            }

            .btn-save {
                padding: 10px 20px;
                background-color: #d9d9d9;
                border: none;
                border-radius: 10px;
                font-weight: 600;
                cursor: pointer;
                transition: 0.3s;
            }

            .btn-save:hover {
                background-color: #c6c6c6;
            }
        </style>

        <div class="content-wrapper">
            <div class="card">
                <h2>Kategori</h2>
<!--No, Kode, Nama Kategori, Batas Umur, Gender, Aksi-->
                <form action="#" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" id="kode" name="kode">
                    </div>

                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" id="nama_kategori" name="nama_kategori">
                    </div>

                    <div class="form-group">
                        <label for="batas_umur">Batas Umur</label>
                        <input type="text" id="batas_umur" name="batas_umur">
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <input type="text" id="gender" name="gender">
                    </div>

                    <div class="btn-wrapper">
                        <button type="submit" class="btn-save">Buat</button>
                    </div>
                </form>
            </div>
        </div>

@endsection

@extends('layouts.layout')

@section('title', 'Create hasil dan rekor - Swim Base')

@section('content')

    {{-- Sidebar --}}
    @include('layouts.sidebar.admin')

    {{-- Header --}}
    @include('layouts.header', [
        'title' => 'Create Hasil dan Rekor',
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
            <h2>Create Hasil dan Rekor</h2>

            <form action="#" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_atlet">Nama Atlet</label>
                    <input type="text" id="nama_atlet" name="nama_atlet" value="TI UNSIQ">
                </div>

                <div class="form-group">
                    <label for="event">Event</label>
                    <input type="text" id="event" name="event" value="TI UNSIQ">
                </div>

                <div class="form-group">
                    <label for="nomor_lomba">Nomor Lomba</label>
                    <input type="text" id="nomor_lomba" name="nomor_lomba" value="TI UNSIQ">
                </div>

                <div class="form-group">
                    <label for="waktu">Waktu</label>
                    <input type="text" id="waktu" name="waktu" value="TI UNSIQ">
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}">
                </div>

                <div class="btn-wrapper">
                    <button type="submit" class="btn-save">Buat</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@extends('layouts.layout')

@section('title', 'Hapus sekolah - Swim Base')

@section('content')
    @include('layouts.sidebar.admin')
    @include('layouts.header', ['title' => 'Hapus sekolah'])

    <style>
        .content-wrapper {
            margin-left: 250px;
            padding: 30px;
            background: #f8f9fc;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .delete-card {
            background: #fff;
            width: 420px;
            padding: 30px;
            border-radius: 8px;
            border: 1px solid #ddd;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .delete-card h2 {
            color: #c0392b;
            margin-bottom: 15px;
        }

        .delete-card p {
            color: #555;
            margin-bottom: 25px;
            font-size: 15px;
        }

        .delete-info {
            background: #f4f6f8;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .delete-actions {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .btn-cancel {
            background: #bdc3c7;
            border: none;
            padding: 8px 18px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            color: #2c3e50;
        }

        .btn-delete {
            background: #c0392b;
            border: none;
            padding: 8px 18px;
            border-radius: 4px;
            cursor: pointer;
            color: white;
        }

        .btn-cancel:hover {
            background: #95a5a6;
        }

        .btn-delete:hover {
            background: #a93226;
        }
    </style>

    <div class="content-wrapper">
        <div class="delete-card">
            <h2>Hapus Data sekolah</h2>
            <p>Apakah kamu yakin ingin menghapus data berikut?</p>

            <div class="delete-info">
                <strong>Nama sekolah:</strong> {{ $sekolah->name }} <br>
                <strong>Kota:</strong> {{ $sekolah->city }}
            </div>

            <form action="{{ route('sekolah.destroy', $sekolah->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="delete-actions">
                    <a href="{{ route('sekolah.index') }}" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-delete">Hapus</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@extends('layout')

@section('title', 'Galeri')

@section('content')

    <style>
        .galeri-container {
            width: 100%;
            margin: 0 auto;
            background: #f8f8f8;
            padding-bottom: 40px;
        }

        .galeri-header img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-bottom: 3px solid #ccc;
        }

        .galeri-grid {
            margin: 30px auto;
            width: 85%;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .galeri-item {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.2);
            transition: .3s;
        }

        .galeri-item:hover {
            transform: scale(1.03);
        }

        .galeri-item img {
            width: 100%;
            height: 170px;
            object-fit: cover;
        }

        .galeri-caption {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.4);
            color: #fff;
            text-align: center;
            font-size: 14px;
            padding: 5px 0;
        }

        footer {
            width: 100%;
            text-align: center;
            padding: 20px 0;
            font-size: 13px;
            color: #333;
            background: #f8f8f8;
        }
    </style>

    <div class="galeri-container">

        {{-- GAMBAR BESAR --}}
        <div class="galeri-header">
            <img src="{{ asset('images/statistik/swimgaleri.png') }}" alt="Galeri Swim">
        </div>

        {{-- GRID GALERI --}}
        <div class="galeri-grid">
            @for($i = 1; $i <= 3; $i++)
                <div class="galeri-item">
                    <img src="{{ asset('images/statistik/' . $i . '.png') }}">
                    <div class="galeri-caption">Deskripsi singkat</div>
                </div>
            @endfor

            @for($i = 1; $i <= 3; $i++)
                <div class="galeri-item">
                    <img src="{{ asset('images/statistik/' . $i . '.png') }}">
                    <div class="galeri-caption">Deskripsi singkat</div>
                </div>
            @endfor
        </div>

    </div>

    <footer>
        Copyrights © 2025 Swim Base. All Rights Reserved
    </footer>

@endsection
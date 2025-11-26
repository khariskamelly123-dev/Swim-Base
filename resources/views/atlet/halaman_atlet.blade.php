@extends('layouts.app')

@section('content')

    <style>
        body {
            background: #e9ebf2;
            font-family: Arial, sans-serif;
        }

        /* HEADER IMAGE */
        .header-image {
            width: 100%;
            height: 280px;
            border-radius: 0;
            overflow: hidden;
        }

        .header-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* CARD GRID */
        .atlet-container {
            width: 80%;
            margin: 30px auto 80px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 25px;
        }

        .atlet-card {
            background: #fff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.1);
        }

        .atlet-card h4 {
            margin: 0;
            font-size: 16px;
            color: #000;
            font-weight: bold;
            position: relative;
            padding-bottom: 5px;
        }

        .atlet-card h4::after {
            content: "";
            width: 40px;
            height: 3px;
            background: #d40000;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .atlet-card p {
            font-size: 20px;
            font-weight: 700;
            margin-top: 20px;
            color: #111;
        }
    </style>

    {{-- HEADER IMAGE --}}
    <div class="header-image">
        <img src="{{ asset('images/swim.png') }}" alt="Swim Header">
    </div>

    {{-- CARD CONTENT --}}
    <div class="atlet-container">

        <div class="atlet-card">
            <h4>ATLET</h4>
            <p>Menampilkan total atlet</p>
        </div>

        <div class="atlet-card">
            <h4>CLUB</h4>
            <p>Menampilkan total klub</p>
        </div>

        <div class="atlet-card" style="grid-column: span 2;">
            <h4>ATLET</h4>
            <p>Menampilkan best time & persentase FP</p>
        </div>

    </div>

@endsection
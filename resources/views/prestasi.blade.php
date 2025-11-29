@extends('layouts.layout')

@section('content')

    <style>
        body {
            background: #e9ebf2;
            font-family: Arial, sans-serif;
        }

        /* TITLE SECTION */
        .prestasi-header {
            text-align: center;
            margin-top: 40px;
        }

        .prestasi-header h1 {
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .prestasi-header h1 span {
            color: #d40000;
        }

        .prestasi-header h2 {
            font-size: 24px;
            margin-top: -5px;
            letter-spacing: 1.5px;
        }

        .prestasi-header p {
            width: 60%;
            margin: 20px auto;
            font-size: 14px;
            line-height: 1.6;
            color: #444;
        }

        /* CARD LIST */
        .prestasi-list {
            width: 70%;
            margin: 30px auto 60px;
        }

        .prestasi-item {
            background: #fff;
            padding: 20px 25px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
        }

        .prestasi-item h3 {
            font-size: 22px;
            font-weight: bold;
            margin: 0;
        }

        /* BUTTON */
        .btn-drop {
            background: #d40000;
            border: none;
            color: white;
            padding: 10px 18px;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
            letter-spacing: 1px;
            font-size: 14px;
        }

        .btn-drop:hover {
            background: #a40000;
        }
    </style>

    <div class="prestasi-header">
        <h1>PROGRAM <span>PRESTASI</span></h1>
        <h2>INDONESIAN SWIMMING ATHLETES</h2>
        <p>
            The Indonesian Swimming Athletes Performance Program is designed to help swimmers reach their highest potential
            through structured training, evaluation, and rigorous performance assessment. This program aims to enhance the
            athlete’s technique, stamina, and overall achievements in competitive swimming. Coaches and trainers provide
            guidance and support to ensure athletes stay motivated and committed to continuous improvement. The goal is to
            develop world-class swimmers and provide opportunities for growth and success in high-performance swimming
            activities.
        </p>
    </div>

    <div class="prestasi-list">

        <div class="prestasi-item">
            <h3>2025</h3>
            <button class="btn-drop">DROP DOWN</button>
        </div>

        <div class="prestasi-item">
            <h3>2025</h3>
            <button class="btn-drop">DROP DOWN</button>
        </div>

        <div class="prestasi-item">
            <h3>2025</h3>
            <button class="btn-drop">DROP DOWN</button>
        </div>

        <div class="prestasi-item">
            <h3>2025</h3>
            <button class="btn-drop">DROP DOWN</button>
        </div>

    </div>

@endsection
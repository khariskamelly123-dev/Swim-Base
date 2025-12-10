@extends('layouts.navbaroutlogin')

@section('content')

    <style>
        .hero-banner img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .ranking-section {
            background: #f2f2f7;
            padding: 40px 0;
            text-align: center;
        }

        .ranking-section .title {
            font-size: 40px;
            font-weight: 800;
        }

        .ranking-section .subtitle {
            margin-top: -10px;
            font-size: 18px;
            color: #777;
        }

        .table-container {
            width: 85%;
            margin: 30px auto;
            overflow-x: auto;
        }

        .ranking-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        .ranking-table thead {
            background: #111;
            color: white;
        }

        .ranking-table th,
        .ranking-table td {
            padding: 12px;
            border: 1px solid #ddd;
            font-size: 15px;
        }

        .prestasi-section {
            background: white;
            padding: 40px 50px;
        }

        .prestasi-title {
            font-size: 28px;
            font-weight: 700;
        }

        .prestasi-content {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            gap: 20px;
        }

        .prestasi-text {
            flex: 1;
            font-size: 16px;
        }

        .prestasi-img img {
            width: 300px;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        @media(max-width: 768px) {
            .prestasi-content {
                flex-direction: column;
            }

            .prestasi-img img {
                width: 100%;
                height: 250px;
            }
        }
    </style>

    <div class="hero-banner">
        <img src="{{asset('images/dashboard-swim.png') }}" alt="Banner">
    </div>

    <section class="ranking-section">
        <h1 class="title">RANKING</h1>
        <p class="subtitle">Regular Season</p>

        <div class="table-container">
            <table class="ranking-table">
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Team</th>
                        <th>Match Poin</th>
                        <th>Match W-L</th>
                        <th>Net Game Win</th>
                        <th>Game W-L</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Unsiq Indah</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="prestasi-section">
        <h2 class="prestasi-title">PRESTASI</h2>

        <div class="prestasi-content">
            <div class="prestasi-text">
                <p>Deskripsi prestasi atlet atau klub dapat ditampilkan di sini.</p>
            </div>

            <div class="prestasi-img">
                <img src="/images/prestasi-swim.png" alt="Prestasi">
            </div>
        </div>
    </section>

@endsection
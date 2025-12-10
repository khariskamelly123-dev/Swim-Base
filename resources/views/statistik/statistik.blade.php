@extends('layouts.layout')

@section('content')

    <style>
        /* Wrapper halaman keseluruhan */
        .stats-wrapper {
            width: 100%;
            padding: 60px 40px;
            text-align: center;
        }

        /* Judul */
        .stats-title {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        /* TAB MENU */
        .stats-tabs {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-bottom: 30px;
            position: relative;
        }

        .tab-item {
            font-size: 22px;
            font-weight: 700;
            color: #000;
            letter-spacing: 1px;
            padding-bottom: 5px;
            text-decoration: none;
            opacity: 0.7;
        }

        .tab-item.active {
            opacity: 1;
            border-bottom: 3px solid #d10c0c;
        }

        /* TABLE SCROLL (biar landscape + horizontal scroll) */
        .table-scroll {
            width: 100%;
            overflow-x: auto;
        }

        /* Tabelnya */
        .stats-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        .stats-table th,
        .stats-table td {
            border: 1px solid #ddd;
            padding: 10px 16px;
            text-align: left;
            font-size: 15px;
            white-space: nowrap;
        }

        /* Header tabel */
        .stats-table thead {
            background: #000;
            color: white;
            font-weight: 700;
        }

        .stats-table th.red,
        .stats-table td.red {
            color: #d10c0c;
            font-weight: 700;
        }

        .stats-table tbody tr:nth-child(even) {
            background: #f8f8f8;
        }
    </style>

    <div class="stats-wrapper">

        <h1 class="stats-title">STATISTIK</h1>

        <!-- TAB MENU -->
        <div class="stats-tabs">
            <a href="{{ route('statistik.team') }}" class="tab-item {{ request()->is('statistik/team') ? 'active' : '' }}">
                TEAM
            </a>

            <a href="{{ route('statistik.atlet') }}"
                class="tab-item {{ request()->is('statistik/atlet') ? 'active' : '' }}">
                ATLET
            </a>
        </div>

        <!-- TABLE WRAPPER -->
        <div class="table-scroll">
            <table class="stats-table">
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Team</th>
                        <th class="red">Match Point</th>
                        <th>Match W-L</th>
                        <th class="red">Net Game Win</th>
                        <th>Game W-L</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($data as $row)
                        <tr>
                            <td>{{ $row['rank'] }}</td>
                            <td>{{ $row['team'] }}</td>
                            <td class="red">{{ $row['match_point'] }}</td>
                            <td>{{ $row['match_wl'] }}</td>
                            <td class="red">{{ $row['net_game_win'] }}</td>
                            <td>{{ $row['game_wl'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; padding:20px;">
                                Tidak ada data.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

    </div>
@endsection
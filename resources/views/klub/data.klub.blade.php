@extends('layouts.layout')

@section('title', 'Manajemen Klub - Swim Base')

@section('content')
    @include('layouts.sidebar.admin')
    @include('layouts.header', ['title' => 'Management Klub', 'link' => route('club.create')])

    <style>
        /* ====== WRAPPER ====== */
        .content-wrapper {
            margin-left: 250px;
            /* menyesuaikan dengan width sidebar */
            padding: 20px;
            background: #f8f9fc;
            min-height: 100vh;
        }

        /* ====== HEADER STYLE (Jika diperlukan di sini juga) ====== */
        .header-area {
            background: #ffffff;
            padding: 20px 25px;
            border-bottom: 3px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-area h2 {
            margin: 0;
            font-weight: 700;
            color: #222;
            border-bottom: 3px solid #e74c3c;
            display: inline-block;
            padding-bottom: 4px;
        }

        .header-area a {
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            color: #e74c3c;
        }

        .header-area a:hover {
            text-decoration: underline;
        }

        /* ====== TABLE DESIGN ====== */
        .table-wrapper {
            background: white;
            padding: 20px;
            margin-top: 10px;
            border: 1px solid #d3d3d3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }

        thead tr {
            background: #000;
            color: #fff;
            text-align: left;
        }

        th,
        td {
            padding: 10px 12px;
            border-bottom: 1px solid #ccc;
        }

        tbody tr:hover {
            background: #f2f2f2;
        }

        /* ====== ACTION BUTTON ====== */
        td .btn-action {
            text-decoration: none;
            font-weight: 550;
            margin-right: 10px;
        }

        td .edit {
            color: #2980b9;
        }

        td .delete {
            color: #c0392b;
        }

        td .btn-action:hover {
            text-decoration: underline;
        }
    </style>

    <div class="content-wrapper">

        <!-- TABEL -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Club</th>
                        <th>kota</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clubs as $index => $club)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $club->name }}</td>
                            <td>{{ $club->city }}</td>
                            <td>
                                <a href="{{ route('club.edit', $club->id) }}" class="btn-action edit">Edit</a>
                                <a href="{{ route('club.delete', $club->id) }}" class="btn-action delete">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
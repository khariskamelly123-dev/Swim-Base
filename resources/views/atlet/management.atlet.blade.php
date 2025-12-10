@extends('layouts.layout')

@section('title', 'Manajemen Atlet - Swim Base')

@section('content')
@include('layouts.sidebar.atlet')
@include('layouts.header', [
    'title' => 'Management Atlet', 
    'link' => route('atlet.create')
])

<style>
    /* ====== WRAPPER ====== */
    .content-wrapper {
        margin-left: 250px; /* menyesuaikan ukuran sidebar */
        padding: 20px;
        background: #f8f9fc;
        min-height: 100vh;
    }

    /* ====== TABLE ====== */
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

    th, td {
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

    <!-- TABLE -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>NIM</th>
                    <th>Nama Atlet</th>
                    <th>DoB</th>
                    <th>Club</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($atlets as $index => $atlet)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $atlet->nim }}</td>
                        <td>{{ $atlet->name }}</td>
                        <td>{{ $atlet->dob }}</td>
                        <td>{{ $atlet->club }}</td>
                        <td>
                            <a href="{{ route('atlet.edit', $atlet->id) }}" class="btn-action edit">Edit</a>
                            <a href="{{ route('atlet.delete', $atlet->id) }}" class="btn-action delete">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
@endsection

@extends('layouts.layout')

@section('title', 'kategori - Swim Base')

@section('content')
        @include('layouts.sidebar.admin')
        @include('layouts.header', [
    'title' => 'kategori',
    'link' => route('kategori.create')
])

        <style>
            /* ====== WRAPPER ====== */
            .content-wrapper {
                margin-left: 250px; 
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
                        <!--No, Kode, Nama Kategori, Batas Umur, Gender, Aksi-->
                       <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Kategori</th>
                            <th>Batas Umur</th>
                            <th>Gender</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>

                    <tbody>
                        @foreach ($kategories as $index => $kategori)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $kategori->kode }}</td>
                                <td>{{ $kategori->nama_kategori }}</td>
                                <td>{{ $kategori->batas_umur }}</td>
                                <td>{{ $kategori->gender }}</td>
                                <td>
                                    <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn-action edit">Edit</a>
                                    <a href="{{ route('kategori.delete', $kategori->id) }}" class="btn-action delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
@endsection

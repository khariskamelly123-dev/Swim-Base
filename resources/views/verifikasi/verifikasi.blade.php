@extends('layouts.layout')

@section('title', 'Verifikasi - Swim Base')

@section('content')
                @include('layouts.sidebar.admin')
                @include('layouts.header', [
        'title' => 'Verifikasi',
        'link' => route('')
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
        <!-- Tanggal Pengajuan, Jenis Data, Pengaju, Ringkasan Data, Bukti Dokumen,  Status Saat Ini, Tombol Aksi: Setujui (Approve) dan Tolak  -->
                               <tr>
                                    <th>No</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Jenis Data</th>
                                    <th>Pengaju</th>
                                    <th>Ringkasan Data</th>
                                    <th>Bukti Dokumen</th>
                                    <th>Status </th>
                                    <th>Aksi</th>

                                </tr>

                            </thead>

                            <tbody>
                                @foreach($verifikasis as $index => $verifikasi)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $verifikasi->tanggal_pengajuan->format('d-m-Y') }}</td>
                                                <td>{{ $verifikasi->jenis_data }}</td>
                                                <td>{{ $verifikasi->pengaju }}</td>
                                                <td>{{ $verifikasi->ringkasan_data }}</td>
                                                <td>{{ $verifikasi->bukti_dokumen }}</td>
                                                <td>{{ $verifikasi->status }}</td>
                                                <td>{{ ucfirst($verifikasi->status) }}</td>
                                    <td>
                                        @if($verifikasi->status === 'pending')
                                            <form action="{{ route('verifikasi.setujui', $verifikasi->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                <button class="btn-action edit">Setujui</button>
                                            </form>

                                            <form action="{{ route('verifikasi.tolak', $verifikasi->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                <button class="btn-action delete"
                                                    onclick="return confirm('Yakin ingin menolak data ini?')">
                                                    Tolak
                                                </button>
                                            </form>
                                        @else
                                            <span>{{ ucfirst($verifikasi->status) }}</span>
                                        @endif
                                    </td>
                                            </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
@endsection

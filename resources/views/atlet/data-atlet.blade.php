@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Data Atlet</h3>

    <a href="{{ route('atlet.create') }}" class="btn btn-primary mb-3">Tambah Atlet</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>TTL</th>
                <th>JK</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($atlets as $a)
            <tr>
                <td>{{ $a->nama }}</td>
                <td>{{ $a->tempat_lahir }}, {{ $a->tanggal_lahir }}</td>
                <td>{{ $a->jenis_kelamin }}</td>
                <td>
                    <a href="{{ route('pengajuan.edit', $a->id) }}" class="btn btn-warning btn-sm">
                        Ajukan Edit
                    </a>

                    <a href="{{ route('pengajuan.hapus', $a->id) }}" class="btn btn-danger btn-sm">
                        Ajukan Hapus
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

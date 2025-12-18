@extends('layouts.app')

@section('content')
    <h3>Data Atlet</h3>

    <!-- tombol tambah hanya untuk klub (role check) -->
    @php $role = auth()->user()->role ?? 'klub'; @endphp

    @if($role == 'klub')
        <a href="{{ route('atlet.create') }}" class="btn btn-primary mb-3">Tambah Atlet</a>
    @endif

<<<<<<<<< Temporary merge branch 1
<table class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Cabang</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($atlet as $i => $a)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $a->nama }}</td>
            <td>{{ $a->tanggal_lahir }}</td>
            <td>{{ $a->kategori_renang }}</td>
            <td>
                @if($role == 'klub')
                    <a href="{{ route('pengajuan.formEdit', $a->id) }}" class="btn btn-sm btn-info">Ajukan Edit</a>
                    <a href="{{ route('pengajuan.formHapus', $a->id) }}" class="btn btn-sm btn-warning">Ajukan Hapus</a>
                @endif
=========
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Cabang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($atlet as $i => $a)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $a->nama }}</td>
                    <td>{{ $a->tanggal_lahir }}</td>
                    <td>{{ $a->kategori_renang }}</td>
                    <td>
                        @if($role == 'klub')
                            <a href="{{ route('pengajuan.formEdit', $a->id) }}" class="btn btn-sm btn-info">Ajukan Edit</a>
                            <a href="{{ route('pengajuan.formHapus', $a->id) }}" class="btn btn-sm btn-warning">Ajukan Hapus</a>
                        @endif
>>>>>>>>> Temporary merge branch 2

                        @if($role == 'superadmin')
                            <a href="{{ route('atlet.edit', $a->id) }}" class="btn btn-sm btn-secondary">Edit</a>

                            <form action="{{ route('atlet.destroy', $a->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Hapus atlet?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
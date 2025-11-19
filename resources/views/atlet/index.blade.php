@extends('layouts.app')

@section('content')
<h3 class="mb-4">Data Atlet</h3>

<a href="{{ route('atlet.create') }}" class="btn btn-primary mb-3">
    + Tambah Atlet
</a>

<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Umur</th>
            <th>Kelamin</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($atlet as $a)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $a->nama }}</td>
            <td>{{ $a->umur }}</td>
            <td>{{ $a->kelamin }}</td>
            <td>{{ $a->keterangan }}</td>

            <td>
                {{-- Untuk Klub: Hanya Ajukan Edit/Hapus --}}
                @if(auth()->user()->role == 'klub')
                    <a href="{{ route('pengajuan.formEdit', $a->id) }}"
                       class="btn btn-warning btn-sm">Ajukan Edit</a>

                    <a href="{{ route('pengajuan.formHapus', $a->id) }}"
                       class="btn btn-danger btn-sm">Ajukan Hapus</a>
                @endif

                {{-- Untuk Super Admin: CRUD langsung --}}
                @if(auth()->user()->role == 'superadmin')
                    <a href="{{ route('atlet.edit', $a->id) }}"
                       class="btn btn-info btn-sm">Edit</a>

                    <form action="{{ route('atlet.destroy', $a->id) }}" 
                          method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Belum ada data atlet</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection

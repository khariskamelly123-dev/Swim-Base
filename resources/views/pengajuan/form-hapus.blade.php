@extends('layouts.app')

@section('content')
<h3>Ajukan Hapus: {{ $atlet->nama }}</h3>

<form action="{{ route('pengajuan.hapus', $atlet->id) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Alasan Penghapusan</label>
        <textarea name="alasan" class="form-control" required></textarea>
    </div>

    <button class="btn btn-danger">Kirim Pengajuan Hapus</button>
</form>
@endsection

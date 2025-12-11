@extends('layouts.app')

@section('content')
<h3>Ajukan Edit: {{ $atlet->nama }}</h3>

<form action="{{ route('pengajuan.edit', $atlet->id) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama (baru)</label>
        <input type="text" name="perubahan[nama]" class="form-control" value="{{ $atlet->nama }}">
    </div>

    <div class="mb-3">
        <label>Tanggal Lahir (baru)</label>
        <input type="date" name="perubahan[tanggal_lahir]" class="form-control" value="{{ $atlet->tanggal_lahir }}">
    </div>

    <div class="mb-3">
        <label>Alasan (opsional)</label>
        <textarea name="alasan" class="form-control"></textarea>
    </div>

    <button class="btn btn-primary">Kirim Pengajuan</button>
</form>
@endsection

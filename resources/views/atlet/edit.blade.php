@extends('layouts.app')

@section('content')
<h3>Edit Atlet</h3>

<form action="{{ route('atlet.update', $atlet->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" value="{{ $atlet->nama }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="{{ $atlet->tanggal_lahir }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Cabang Olahraga</label>
        <input type="text" name="kategori_renang" value="{{ $atlet->kategori_renang }}" class="form-control">
    </div>

    <button class="btn btn-primary">Update</button>
</form>
@endsection

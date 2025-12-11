@extends('layouts.app')

@section('content')
    <h3>Edit Atlet</h3>

<<<<<<< HEAD
    <form action="{{ route('atlet.update', $atlet->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ $atlet->nama }}" class="form-control" required>
        </div>
=======
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
>>>>>>> 26333f47378d864bfee574953ec54e984367006c

        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ $atlet->tanggal_lahir }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Gender</label>
            <select name="gender" class="form-control">
                <option value="">-</option>
                <option value="L" {{ $atlet->gender == 'L' ? 'selected' : '' }}>L</option>
                <option value="P" {{ $atlet->gender == 'P' ? 'selected' : '' }}>P</option>
            </select>
        </div>
        <div class="mb-3">
            <label>kategori_renang</label>
            <input type="text" name="cabang_olahraga" value="{{ $atlet->cabang_olahraga }}" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
@endsection
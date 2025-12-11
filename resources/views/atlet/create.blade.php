@extends('layouts.app')

@section('content')
    <h3>Tambah Atlet</h3>

<form action="{{ route('atlet.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

<<<<<<<<< Temporary merge branch 1
    <div class="mb-3">
        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="form-control">
    </div>

    <div class="mb-3">
        <label>Cabang Olahraga</label>
        <input type="text" name="kategori_renang" class="form-control">
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>
@endsection
=========
        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control">
        </div>

    <div class="mb-3">
        <label>Gender</label>
        <select name="gender" class="form-control">
            <option value="">-</option>
            <option value="L">L</option>
            <option value="P">P</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Cabang Olahraga</label>
        <input type="text" name="cabang_olahraga" class="form-control">
    </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
@endsection
>>>>>>>>> Temporary merge branch 2

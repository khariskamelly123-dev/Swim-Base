@extends('layouts.app')

@section('content')
<h3>Daftar Pengajuan</h3>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Atlet</th>
            <th>Tipe</th>
            <th>Alasan</th>
            <th>Data Baru</th>
            <th>Status</th>
            <th>Dibuat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pengajuan as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->atlet? $p->atlet->nama : '-' }}</td>
            <td>{{ $p->tipe_pengajuan }}</td>
            <td>{{ $p->alasan }}</td>
            <td>
                @if($p->data_baru)
                    <pre style="white-space:pre-wrap">{{ json_encode($p->data_baru, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) }}</pre>
                @else
                    -
                @endif
            </td>
            <td>{{ $p->status }}</td>
            <td>{{ $p->created_at->format('Y-m-d H:i') }}</td>
            <td>
                @if($p->status == 'pending')
                    <form action="{{ route('pengajuan.approve', $p->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-success btn-sm">Setujui</button>
                    </form>

                    <form action="{{ route('pengajuan.reject', $p->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-danger btn-sm">Tolak</button>
                    </form>
                @else
                    <small>{{ $p->status }} oleh {{ $p->approved_by ?? '-' }}</small>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

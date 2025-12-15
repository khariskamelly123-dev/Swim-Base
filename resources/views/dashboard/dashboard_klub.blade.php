@extends('layouts.dashboard')

@section('title', 'Dashboard Klub')

@section('styles')
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
@endsection

@section('content')
    {{-- Header --}}
    <header class="glass-effect border-b border-gray-200/60 h-20 flex items-center justify-between px-8 sticky top-0 z-30">
        {{-- Isi Header (Overview, Search, Bell) --}}
        <div>
            <h2 class="text-xl font-bold text-gray-800">Overview</h2>
            <p class="text-xs text-gray-500 mt-0.5">Dashboard Klub</p>
        </div>
        {{-- ... sisa kode header ... --}}
    </header>

    {{-- Main Content --}}
    <main class="flex-1 overflow-x-hidden overflow-y-auto p-8">
        {{-- Isi Cards & Tabel --}}
    </main>
@endsection
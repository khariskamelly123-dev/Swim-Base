@extends('layouts.layout') 

@section('title', 'Beranda - Swim Base')

@section('content')

{{-- IMPORT FONT BARU (POPPINS) --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* GLOBAL FONT SETTING */
    body {
        font-family: 'Poppins', sans-serif !important;
    }

    /* 1. HERO SECTION (DIPERKECIL & DIPERBAIKI) */
    .hero-section {
        /* Tinggi dikurangi biar tidak terlalu besar */
        height: 75vh; 
        min-height: 500px; 
        
        /* Background Image dengan Overlay Gelap biar tulisan terbaca */
        background: linear-gradient(to bottom, rgba(15, 23, 42, 0.7), rgba(15, 23, 42, 0.4)), url("{{ asset('images/bg-swim.jpg') }}");
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
        color: white;
        margin-top: -80px; /* Kompensasi navbar */
        padding-top: 80px;
    }

    .hero-content {
        max-width: 700px; /* Lebar konten dibatasi biar fokus */
        padding: 20px;
        animation: fadeInUp 0.8s ease-out;
    }

    .hero-title {
        /* Ukuran font disesuaikan (tidak terlalu raksasa) */
        font-size: 3rem; 
        font-weight: 800; /* Extra Bold biar sporty */
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        line-height: 1.2;
        text-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }
    
    .hero-highlight {
        color: #D92323; /* Merah aksen */
    }

    .hero-subtitle {
        font-size: 1.1rem; /* Ukuran standar mudah dibaca */
        color: #e2e8f0;
        margin-bottom: 2rem;
        font-weight: 300;
        line-height: 1.6;
    }

    /* BUTTONS */
    .hero-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .btn-hero {
        padding: 10px 30px; /* Padding tombol diperkecil dikit */
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background: #D92323;
        color: white;
        border: 2px solid #D92323;
        box-shadow: 0 4px 15px rgba(217, 35, 35, 0.3);
    }
    .btn-primary:hover {
        background: #b91c1c;
        border-color: #b91c1c;
        transform: translateY(-2px);
    }

    .btn-outline {
        border: 2px solid rgba(255,255,255,0.8);
        color: white;
        background: transparent;
    }
    .btn-outline:hover {
        background: white;
        color: #0f172a;
        transform: translateY(-2px);
    }

    /* 2. STATS BAR (GLASSMORPHISM) */
    .stats-bar-wrapper {
        margin-top: -40px; /* Naik ke atas hero */
        padding: 0 20px;
        position: relative;
        z-index: 10;
    }

    .stats-container {
        display: flex;
        justify-content: space-around;
        align-items: center;
        background: rgba(30, 41, 59, 0.85); /* Semi transparan */
        backdrop-filter: blur(10px); /* Efek kaca */
        border: 1px solid rgba(255,255,255,0.1);
        padding: 25px 40px;
        border-radius: 16px;
        max-width: 900px;
        margin: 0 auto;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    .stat-item {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #38bdf8; /* Biru muda cerah */
        line-height: 1;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #cbd5e1;
        font-weight: 500;
    }

    /* 3. CONTENT SECTIONS */
    .section-padding {
        padding: 70px 20px;
        background: #0f172a; /* Dark Theme Base */
    }

    .section-header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .section-title {
        color: white;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .section-line {
        width: 60px;
        height: 4px;
        background: #D92323;
        margin: 0 auto;
        border-radius: 2px;
    }

    /* EVENT CARDS (Lebih Rapi) */
    .events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Responsive */
        gap: 25px;
        max-width: 1100px;
        margin: 0 auto;
    }

    .event-card {
        background: #1e293b;
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #334155;
        display: flex;
        flex-direction: column;
    }
    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        border-color: #D92323;
    }

    .event-img-wrapper {
        height: 160px; /* Tinggi gambar dikecilkan */
        position: relative;
        overflow: hidden;
    }
    .event-img-wrapper img {
        transition: transform 0.5s ease;
    }
    .event-card:hover .event-img-wrapper img {
        transform: scale(1.05); /* Zoom effect dikit */
    }

    .date-tag {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(217, 35, 35, 0.9);
        color: white;
        padding: 6px 12px;
        border-radius: 8px;
        text-align: center;
        backdrop-filter: blur(4px);
    }
    .date-day { font-size: 1.2rem; font-weight: 700; display: block; line-height: 1; }
    .date-month { font-size: 0.7rem; text-transform: uppercase; font-weight: 600; }

    .event-body {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .event-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: white;
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .event-meta {
        font-size: 0.85rem;
        color: #94a3b8;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .event-footer {
        margin-top: auto;
        padding-top: 15px;
        border-top: 1px solid #334155;
    }
    
    .link-detail {
        color: #38bdf8;
        font-size: 0.85rem;
        text-decoration: none;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: gap 0.2s;
    }
    .link-detail:hover { gap: 8px; }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .hero-title { font-size: 2.2rem; }
        .stats-container { flex-direction: column; gap: 20px; padding: 20px; }
        .stats-bar-wrapper { margin-top: 0; background: #1e293b; padding: 20px 0; }
        .stats-container { background: transparent; box-shadow: none; border: none; }
    }

    /* ANIMATION */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

{{-- 1. HERO SECTION --}}
<div class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Swim Base <span class="hero-highlight">ID</span></h1>
        <p class="hero-subtitle">
            Platform manajemen kompetisi renang #1. <br> Pantau hasil lomba, data atlet, dan statistik secara real-time.
        </p>
        <div class="hero-buttons">
            <a href="{{ route('events.list') }}" class="btn-hero btn-primary">
                <i class="fas fa-calendar-alt"></i> Lihat Event
            </a>
            <a href="{{ route('athletes.index') }}" class="btn-hero btn-outline">
                <i class="fas fa-users"></i> Data Atlet
            </a>
        </div>
    </div>
</div>

{{-- 2. STATS BAR (Floating) --}}
<div class="stats-bar-wrapper">
    <div class="stats-container">
        <div class="stat-item">
            <div class="stat-number">{{ \App\Models\Athlete::count() }}</div>
            <div class="stat-label">Total Atlet</div>
        </div>
        <div class="stat-item" style="border-left: 1px solid rgba(255,255,255,0.1); border-right: 1px solid rgba(255,255,255,0.1); padding: 0 40px;">
            <div class="stat-number">{{ \App\Models\Club::count() }}</div>
            <div class="stat-label">Klub Terdaftar</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ \App\Models\Event::count() }}</div>
            <div class="stat-label">Event Kompetisi</div>
        </div>
    </div>
</div>

{{-- 3. UPCOMING EVENTS --}}
<section class="section-padding">
    <div class="container mx-auto">
        <div class="section-header">
            <h2 class="section-title">Event Terbaru</h2>
            <div class="section-line"></div>
        </div>
        
        <div class="events-grid">
            @forelse(\App\Models\Event::latest()->take(3)->get() as $event)
                <div class="event-card">
                    <div class="event-img-wrapper">
                        {{-- Gambar Event (Placeholder Online biar cantik) --}}
                        <img src="https://images.unsplash.com/photo-1519315901367-f34ff9154487?q=80&w=600&auto=format&fit=crop" 
                             style="width:100%; height:100%; object-fit:cover;"
                             alt="{{ $event->name }}">
                        
                        <div class="date-tag">
                            <span class="date-day">{{ $event->start_date->format('d') }}</span>
                            <span class="date-month">{{ $event->start_date->format('M') }}</span>
                        </div>
                    </div>
                    
                    <div class="event-body">
                        <h3 class="event-title">{{ Str::limit($event->name, 40) }}</h3>
                        
                        <div class="event-meta">
                            <i class="fas fa-map-marker-alt" style="width:15px; text-align:center;"></i> 
                            {{ Str::limit($event->location, 30) }}
                        </div>
                        <div class="event-meta">
                            <i class="fas fa-user-friends" style="width:15px; text-align:center;"></i> 
                            {{ $event->participants_count ?? 0 }} Peserta
                        </div>

                        <div class="event-footer">
                            <a href="#" class="link-detail">
                                Detail Event <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align:center; padding: 40px; background: rgba(255,255,255,0.05); border-radius:10px; color:#94a3b8;">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <p>Belum ada event kompetisi yang dijadwalkan.</p>
                </div>
            @endforelse
        </div>
        
        <div style="text-align:center; margin-top:50px;">
            <a href="{{ route('events.list') }}" class="btn-hero btn-outline" style="border-color: #334155; color: #cbd5e1;">
                Lihat Semua Arsip
            </a>
        </div>
    </div>
</section>

{{-- 4. WHY US / FEATURES (Simple Grid) --}}
<section class="section-padding" style="background: #0b1120;">
    <div class="container mx-auto">
        <div class="section-header">
            <h2 class="section-title">Fitur Unggulan</h2>
            <div class="section-line"></div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap:30px; max-width:1100px; margin:0 auto;">
            
            {{-- Feature 1 --}}
            <div style="text-align:center; padding:30px; background:rgba(255,255,255,0.03); border-radius:15px; border:1px solid rgba(255,255,255,0.05);">
                <i class="fas fa-stopwatch" style="font-size:2.5rem; color:#D92323; margin-bottom:20px;"></i>
                <h3 style="color:white; font-size:1.1rem; font-weight:600; margin-bottom:10px;">Live Results</h3>
                <p style="color:#94a3b8; font-size:0.9rem; line-height:1.6;">Hasil pertandingan diperbarui secara real-time, akurat hingga milidetik.</p>
            </div>

            {{-- Feature 2 --}}
            <div style="text-align:center; padding:30px; background:rgba(255,255,255,0.03); border-radius:15px; border:1px solid rgba(255,255,255,0.05);">
                <i class="fas fa-database" style="font-size:2.5rem; color:#38bdf8; margin-bottom:20px;"></i>
                <h3 style="color:white; font-size:1.1rem; font-weight:600; margin-bottom:10px;">Database Terpusat</h3>
                <p style="color:#94a3b8; font-size:0.9rem; line-height:1.6;">Data atlet, klub, dan rekor nasional tersimpan rapi dalam satu sistem terintegrasi.</p>
            </div>

            {{-- Feature 3 --}}
            <div style="text-align:center; padding:30px; background:rgba(255,255,255,0.03); border-radius:15px; border:1px solid rgba(255,255,255,0.05);">
                <i class="fas fa-award" style="font-size:2.5rem; color:#fbbf24; margin-bottom:20px;"></i>
                <h3 style="color:white; font-size:1.1rem; font-weight:600; margin-bottom:10px;">FINA Points</h3>
                <p style="color:#94a3b8; font-size:0.9rem; line-height:1.6;">Kalkulasi poin otomatis berdasarkan standar FINA untuk pemeringkatan atlet.</p>
            </div>

        </div>
    </div>
</section>

@endsection
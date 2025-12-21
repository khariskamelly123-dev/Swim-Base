<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Athlete;
use App\Models\Club;
use App\Models\Event;
use App\Models\Achievement;

class DashboardController extends Controller
{
    // Dashboard untuk Super Admin
    public function superAdmin()
    {
        return view('dashboard.super_admin', [
            'total_athletes' => Athlete::count(),
            'total_clubs' => Club::count(),
            'total_events' => Event::count(),
        ]);
    }

    // Dashboard untuk Admin (Event Organizer)
    public function admin()
    {
        return view('dashboard.admin', [
            'upcoming_events' => Event::where('start_date', '>', now())->get(),
            'total_achievements' => Achievement::count(),
        ]);
    }

    // Dashboard untuk Club (INI YANG TADI ERROR)
    public function club()
    {
        $club = auth()->guard('club')->user();
        
        return view('dashboard.club', [
            'club' => $club,
            'my_athletes' => Athlete::where('club_id', $club->id)->count(),
            // Tambahkan data lain yang ingin ditampilkan di dashboard klub
        ]);
    }

    // Dashboard untuk Institution (Sekolah/Univ)
    public function institution()
    {
        $institution = auth()->guard('institution')->user();

        return view('dashboard.institution', [
            'institution' => $institution,
            'my_athletes' => Athlete::where('institution_id', $institution->id)->count(),
        ]);
    }
}
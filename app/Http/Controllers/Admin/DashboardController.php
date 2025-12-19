<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Models\EventGuest;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */
        $totalUsers = User::count();

        // ⚠️ SESUAIKAN DENGAN STRUKTUR USER KAMU
        // jika pakai role string: 'eo'
        $totalOrganizers = User::where('role', 'eo')->count();
        // jika pakai role_id, pakai ini:
        // $totalOrganizers = User::where('role_id', 2)->count();

        /*
        |--------------------------------------------------------------------------
        | EVENT
        |--------------------------------------------------------------------------
        */
        $totalEvents = Event::count();
        $pendingEvents = Event::where('status', 'pending')->count();
        $approvedEvents = Event::where('status', 'approved')->count();

        /*
        |--------------------------------------------------------------------------
        | GUEST & RSVP
        |--------------------------------------------------------------------------
        */
        $totalGuests = EventGuest::count();
        $totalRsvp = EventGuest::whereNotNull('rsvp_status')->count();
        $rsvpHadir = EventGuest::where('rsvp_status', 'Hadir')->count();

        /*
        |--------------------------------------------------------------------------
        | CHECK-IN
        |--------------------------------------------------------------------------
        | ⚠️ jika kolom kamu namanya `checkin_time`, ganti attended_at
        */
        $totalCheckedIn = EventGuest::whereNotNull('attended_at')->count();
        // contoh alternatif:
        // $totalCheckedIn = EventGuest::whereNotNull('checkin_time')->count();

        /*
        |--------------------------------------------------------------------------
        | EVENT TERBARU
        |--------------------------------------------------------------------------
        */
        $recentEvents = Event::with(['eo', 'guests'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalOrganizers',
            'totalEvents',
            'pendingEvents',
            'approvedEvents',
            'totalGuests',
            'totalRsvp',
            'rsvpHadir',
            'totalCheckedIn',
            'recentEvents'
        ));
    }
}

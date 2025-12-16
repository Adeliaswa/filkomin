<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Models\Recipient;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers'      => User::count(),
            'totalOrganizers' => User::where('role_id', 2)->count(),
            'totalEvents'     => Event::count(),
            'totalRsvp'       => Recipient::whereNotNull('rsvp_status')->count(),
            'recentEvents'    => Event::latest()->take(5)->get(),
        ]);
    }
}

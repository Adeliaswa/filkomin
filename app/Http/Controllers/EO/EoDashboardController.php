<?php

namespace App\Http\Controllers\Eo;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Template;

class EoDashboardController extends Controller
{
    public function index()
    {
        // GANTI user_id ➜ eo_id
        $events = Event::where('eo_id', auth()->id())
            ->latest()
            ->get();

        $templates = Template::all();

        return view('eo.dashboard', compact('events', 'templates'));
    }
}

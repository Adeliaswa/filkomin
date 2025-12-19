<?php

namespace App\Http\Controllers\Eo;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Template;

class EoDashboardController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', auth()->id())
            ->latest()
            ->get();

        $templates = Template::all();

        return view('eo.dashboard', compact('events', 'templates'));
    }
}

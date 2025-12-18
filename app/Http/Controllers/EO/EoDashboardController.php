<?php

namespace App\Http\Controllers\Eo;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Template;
use Illuminate\Support\Facades\Auth;

class EoDashboardController extends Controller
{
    public function index()
    {
        // Ambil event milik EO yang sedang login
        $events = Event::where('user_id', Auth::id())
            ->latest('updated_at')
            ->get();

        // Template (kalau mau dipakai di view / dropdown)
        $templates = Template::all();

        return view('eo.dashboard', [
            'events' => $events,
            'templates' => $templates,
        ]);
    }
}

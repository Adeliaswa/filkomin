<?php

namespace App\Http\Controllers\Eo;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EoEventController extends Controller
{
    public function create()
    {
        return view('eo.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date'  => 'required|date',
        ]);

        Event::create([
            'title'   => $request->title,
            'date'    => $request->date,
            'user_id' => auth()->id(),
            'status'  => 'Pending',
        ]);

        return redirect()->route('eo.dashboard')
            ->with('success', 'Event created successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('eo_id', Auth::id())
            ->latest()
            ->get();

        return view('events.index', compact('events'));
    }

    public function show(string $id)
    {
        $event = Event::where('eo_id', Auth::id())
            ->with('guests')
            ->findOrFail($id);

        return view('events.show', compact('event'));
    }

    public function destroy(string $id)
    {
        $event = Event::where('eo_id', Auth::id())->findOrFail($id);
        $event->delete();

        return redirect()
            ->route('events.index')
            ->with('success', 'Event berhasil dihapus');
    }
}

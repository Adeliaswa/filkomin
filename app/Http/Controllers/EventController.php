<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Template;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', Auth::id())
                        ->withCount('recipients')
                        ->latest()
                        ->get();
                        
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $templates = Template::all();
        
        return view('events.create', compact('templates'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'event_time' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'template_id' => 'required|exists:templates,id',
            'dresscode' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
        ]);

        $event = Event::create([
            'user_id' => Auth::id(),
            'template_id' => $validatedData['template_id'],
            'title' => $validatedData['title'],
            'event_time' => $validatedData['event_time'],
            'location' => $validatedData['location'],
            'description' => $validatedData['description'],
            'dresscode' => $validatedData['dresscode'],
            'organizer' => $validatedData['organizer'],
        ]);

        return redirect()->route('events.show', $event->id)
                         ->with('success', 'Event "' . $event->title . '" berhasil dibuat!');
    }

    public function show(string $id)
    {
        $event = Event::where('user_id', Auth::id())
                      ->with('template')
                      ->findOrFail($id); 
                      
        $recipients = $event->recipients()->with('rsvpResponse')->latest()->get(); 

        return view('events.show', compact('event', 'recipients'));
    }

    public function edit(string $id)
    {
        $event = Event::where('user_id', Auth::id())->findOrFail($id);
        $templates = Template::all(); 

        return view('events.edit', compact('event', 'templates'));
    }

    public function update(Request $request, string $id)
    {
        $event = Event::where('user_id', Auth::id())->findOrFail($id);
        
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'event_time' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'template_id' => 'required|exists:templates,id',
            'dresscode' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
        ]);

        $event->update($validatedData);

        return redirect()->route('events.show', $event->id)
                         ->with('success', 'Event "' . $event->title . '" berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $event = Event::where('user_id', Auth::id())->findOrFail($id);
        
        $eventName = $event->title;
        $event->delete();

        return redirect()->route('events.index')
                         ->with('success', 'Event "' . $eventName . '" dan semua data terkait berhasil dihapus.');
    }

    public function exportRecipientsPdf(string $eventId)
    {
        $event = Event::with('recipients.rsvpResponse')->findOrFail($eventId);

        if ($event->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki hak akses untuk Event ini.');
        }

        $recipients = $event->recipients;

        $pdf = Pdf::loadView('reports.recipient_list', compact('event', 'recipients'));

        $fileName = 'Laporan_Tamu_' . \Illuminate\Support\Str::slug($event->title) . '_' . date('Ymd') . '.pdf';
        return $pdf->download($fileName);
    }
}
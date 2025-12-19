<?php

namespace App\Http\Controllers\Eo;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventGuest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EoEventController extends Controller
{
    /**
     * LIST EVENT EO
     */
    public function index()
    {
        $events = Event::where('eo_id', auth()->id())
            ->latest()
            ->get();

        return view('eo.events.index', compact('events'));
    }

    /**
     * FORM CREATE EVENT
     */
    public function create()
    {
        return view('eo.events.create');
    }

    /**
     * STORE EVENT (SUBMIT KE ADMIN)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // A. BASIC INFO
            'title'            => 'required|string|max:255',
            'category'         => 'required|in:formal,semi-formal,speaker',
            'organizer_name'   => 'required|string|max:255',
            'organizer_unit'   => 'required|string|max:255',
            'description'      => 'required|string',

            // B. DATE & LOCATION
            'date'             => 'required|date',
            'start_time'       => 'required',
            'end_time'         => 'nullable|after:start_time',
            'location_type'    => 'required|in:onsite,online,hybrid',
            'location'         => 'nullable|string|max:255',
            'meeting_link'     => 'nullable|url',

            // C. INVITATION
            'dress_code'       => 'nullable|string|max:255',
            'notes'            => 'nullable|string',
            'invitation_type'  => 'required|in:link,pdf',

            // D. PIC
            'pic_name'         => 'required|string|max:255',
            'pic_whatsapp'     => 'required|string|max:30',
            'pic_email'        => 'nullable|email',
            'request_notes'    => 'nullable|string',

            // E. GUESTS
            'guests'           => 'required|array|min:1',
            'guests.*.name'    => 'required|string|max:255',
            'guests.*.whatsapp'=> 'required|string|max:30',
        ]);

        // VALIDASI KONDISIONAL
        if (in_array($validated['location_type'], ['online', 'hybrid']) && empty($validated['meeting_link'])) {
            return back()->withErrors([
                'meeting_link' => 'Meeting link wajib diisi untuk event online / hybrid.'
            ])->withInput();
        }

        if ($validated['location_type'] === 'onsite' && empty($validated['location'])) {
            return back()->withErrors([
                'location' => 'Lokasi wajib diisi untuk event onsite.'
            ])->withInput();
        }

        DB::transaction(function () use ($validated) {

            $event = Event::create([
                'eo_id'           => auth()->id(),

                'title'           => $validated['title'],
                'category'        => $validated['category'],
                'organizer_name'  => $validated['organizer_name'],
                'organizer_unit'  => $validated['organizer_unit'],
                'description'     => $validated['description'],

                'date'            => $validated['date'],
                'start_time'      => $validated['start_time'],
                'end_time'        => $validated['end_time'] ?? null,

                'location_type'   => $validated['location_type'],
                'location'        => $validated['location'] ?? null,
                'meeting_link'    => $validated['meeting_link'] ?? null,

                'dress_code'      => $validated['dress_code'] ?? null,
                'notes'           => $validated['notes'] ?? null,

                'invitation_type' => $validated['invitation_type'],

                'pic_name'        => $validated['pic_name'],
                'pic_whatsapp'    => $validated['pic_whatsapp'],
                'pic_email'       => $validated['pic_email'] ?? null,
                'request_notes'   => $validated['request_notes'] ?? null,

                // 🔑 FLOW ADMIN
                'status'          => 'pending',
            ]);

            foreach ($validated['guests'] as $guest) {
                EventGuest::create([
                    'event_id'         => $event->id,
                    'name'             => $guest['name'],
                    'whatsapp'         => $guest['whatsapp'],
                    'invitation_token' => Str::uuid(),
                    'attendance_token' => Str::uuid(),
                ]);
            }
        });

        return redirect()
            ->route('eo.events.index')
            ->with('success', 'Event berhasil dikirim dan sedang ditinjau oleh Admin.');
    }
}

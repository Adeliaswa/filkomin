<?php

namespace App\Http\Controllers\Eo;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EoEventController extends Controller
{
    public function create()
    {
        return view('eo.events.create');
    }

    public function store(Request $request)
    {
        // ✅ VALIDATION
        $data = $request->validate([
            'title'    => 'required|string',
            'date'     => 'required|date',
            'category' => 'required|in:formal,non-formal,speaker',
        ]);

        // ✅ MAP CATEGORY → TEMPLATE
        $template = match ($data['category']) {
            'formal'     => Template::where('name', 'Formal')->first(),
            'non-formal' => Template::where('name', 'Semi-Formal')->first(),
            'speaker'    => Template::where('name', 'Speaker')->first(),
            default      => null,
        };

        if (!$template) {
            return back()->withErrors('Template tidak ditemukan');
        }

        // ✅ CREATE EVENT
        Event::create([
            'title'       => $data['title'],
            'date'        => $data['date'],
            'category'    => $data['category'],
            'user_id'     => auth()->id(),
            'status'      => 'pending',
            'token'       => Str::uuid(),
            'template_id' => $template->id,
        ]);

        return redirect()
            ->route('eo.events.index')
            ->with('success', 'Event berhasil diajukan & menunggu approval');
    }
}

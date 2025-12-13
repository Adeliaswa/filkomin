<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use App\Models\RsvpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class EInvitationController extends Controller
{
    /**
     * Menampilkan e-vite berdasarkan token.
     */
    public function show(string $token)
    {
        $recipient = Recipient::where('token', $token)
                              ->with('event.template', 'rsvpResponse')
                              ->firstOrFail(); 
                              
        $event = $recipient->event;
        $templatePath = $event->template->path;
        
        if (!View::exists($templatePath)) {
            $templatePath = 'templates.default-simple'; 
        }

        $recipientName = $recipient->name;
        
        return view($templatePath, compact('recipient', 'event', 'recipientName'));
    }

    /**
     * Memproses respon RSVP dari tamu undangan.
     */
    public function submitRsvp(Request $request, string $token)
    {
        $recipient = Recipient::where('token', $token)->firstOrFail();

        $validatedData = $request->validate([
            'status' => 'required|in:Hadir,Tidak Hadir,Belum Pasti',
            'notes' => 'nullable|string|max:500', 
            'pax' => 'nullable|integer|min:1',
        ]);
        
        $rsvp = RsvpResponse::updateOrCreate(
            ['recipient_id' => $recipient->id],
            [
                'status' => $validatedData['status'],
                'notes' => $validatedData['notes'] ?? null,
                'pax' => $validatedData['pax'] ?? 1,
            ]
        );

        return redirect()->route('einvite.show', $token)
                         ->with('success', 'Terima kasih, respon RSVP Anda berhasil disimpan!');
    }
}
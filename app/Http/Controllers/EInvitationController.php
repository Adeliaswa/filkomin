<?php

namespace App\Http\Controllers;

use App\Models\EventGuest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EInvitationController extends Controller
{
    /**
     * 📩 MENAMPILKAN UNDANGAN TAMU (WEB)
     * URL: /i/{token}
     */
    public function show(string $token)
    {
        $guest = EventGuest::where('invitation_token', $token)
            ->with('event')
            ->firstOrFail();

        $event = $guest->event;

        // 🔒 hanya event yang sudah di-approve admin
        if ($event->status !== 'approved') {
            abort(403, 'Event belum disetujui admin');
        }

        // 🎨 tentukan view invitation berdasarkan kategori event
        $view = match ($event->category) {
            'formal'       => 'invitation.formal',
            'semi-formal'  => 'invitation.semi-formal',
            'speaker'      => 'invitation.speaker',
            default        => 'invitation.semi-formal',
        };

        if (!view()->exists($view)) {
            abort(404, 'Template undangan tidak ditemukan');
        }

        return view($view, [
            'event' => $event,
            'guest' => $guest,
        ]);
    }

    /**
     * 📄 DOWNLOAD / PREVIEW UNDANGAN PDF
     * URL: /i/{token}/pdf
     */
    public function pdf(string $token)
    {
        $guest = EventGuest::where('invitation_token', $token)
            ->with('event')
            ->firstOrFail();

        $event = $guest->event;

        if ($event->status !== 'approved') {
            abort(403, 'Event belum disetujui admin');
        }

        $view = match ($event->category) {
            'formal'       => 'invitation.formal',
            'semi-formal'  => 'invitation.semi-formal',
            'speaker'      => 'invitation.speaker',
            default        => 'invitation.semi-formal',
        };

        if (!view()->exists($view)) {
            abort(404, 'Template undangan tidak ditemukan');
        }

        $pdf = Pdf::loadView($view, [
            'event' => $event,
            'guest' => $guest,
            'isPdf' => true, // optional flag kalau mau styling khusus pdf
        ]);

        return $pdf->stream(
            'Undangan-' . str_replace(' ', '-', $event->title) . '.pdf'
        );
    }

    /**
     * 📝 SIMPAN RSVP TAMU
     * URL: POST /i/{token}/rsvp
     */
    public function submitRsvp(Request $request, string $token)
    {
        $guest = EventGuest::where('invitation_token', $token)
            ->firstOrFail();

        $validated = $request->validate([
            'status' => 'required|in:Hadir,Tidak Hadir,Belum Pasti',
            'notes'  => 'nullable|string|max:500',
            'pax'    => 'nullable|integer|min:1',
        ]);

        $guest->update([
            'rsvp_status' => $validated['status'],
            'rsvp_notes'  => $validated['notes'] ?? null,
            'rsvp_pax'    => $validated['pax'] ?? 1,
        ]);

        return redirect()
            ->route('einvite.show', $token)
            ->with('success', 'Terima kasih, RSVP Anda berhasil disimpan.');
    }
}

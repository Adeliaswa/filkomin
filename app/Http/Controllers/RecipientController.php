<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use App\Models\Event;
use App\Traits\TokenGenerator;
use App\Http\Requests\StoreRecipientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Jobs\SendInvitationWaNotification;
use Illuminate\Support\Facades\Storage;

class RecipientController extends Controller
{
    use TokenGenerator;

    public function store(StoreRecipientRequest $request, Event $event)
    {
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki hak akses untuk Event ini.');
        }

        $validatedData = $request->validated();
        
        $phoneWa = $validatedData['phone_wa'];
        $phoneWa = preg_replace('/[^0-9]/', '', $phoneWa);
        if (substr($phoneWa, 0, 1) === '0') {
            $phoneWa = '62' . substr($phoneWa, 1);
        }
        $validatedData['phone_wa'] = $phoneWa;
        
        $token = $this->generateUniqueToken(); 

        $checkInUrl = route('checkin.show', $token); 
        
        $qrCodeFileName = 'qr-' . $token . '.svg';
        $qrCodePath = 'public/qrcodes/' . $qrCodeFileName;

        Storage::disk('public')->makeDirectory('qrcodes');

        QrCode::format('svg')->size(300)
              ->generate($checkInUrl, storage_path('app/' . $qrCodePath));

        $validatedData['event_id'] = $event->id;
        $validatedData['token'] = $token;
        $validatedData['qr_code_url'] = $qrCodeFileName;

        $recipient = Recipient::create($validatedData);
        
        SendInvitationWaNotification::dispatch($recipient);

        return redirect()->route('events.show', $recipient->event_id)
                         ->with('success', 'Tamu undangan "' . $recipient->name . '" berhasil ditambahkan, Token dan QR Code berhasil dibuat. Notifikasi WA dikirim di latar belakang.');
    }

    public function update(Request $request, Event $event, Recipient $recipient)
    {
        if ($event->user_id !== Auth::id() || $recipient->event_id !== $event->id) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengubah Tamu ini.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'details' => 'nullable|string',
        ]);
        
        $recipient->update($validatedData);

        return redirect()->route('events.show', $event->id)
                         ->with('success', 'Tamu undangan "' . $recipient->name . '" berhasil diperbarui.');
    }

    public function destroy(Event $event, Recipient $recipient)
    {
        if ($event->user_id !== Auth::id() || $recipient->event_id !== $event->id) {
            abort(403, 'Anda tidak memiliki hak akses untuk menghapus Tamu ini.');
        }

        $eventName = $event->title;
        $recipientName = $recipient->name;
        $eventId = $event->id;

        if ($recipient->qr_code_url) {
            Storage::disk('public')->delete('qrcodes/' . $recipient->qr_code_url);
        }
        
        $recipient->delete();

        return redirect()->route('events.show', $eventId)
                         ->with('success', 'Tamu undangan "' . $recipientName . '" dari Event "' . $eventName . '" berhasil dihapus.');
    }
    
    public function index() { abort(404); }
    public function create() { abort(404); }
    public function show(string $id) { abort(404); }
    public function edit(string $id) { abort(404); }
}
<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    /**
     * Menghasilkan QR Code untuk Recipient tertentu.
     */
    public function generateQrCode(string $recipientId)
    {
        $recipient = Recipient::with('event')
                              ->findOrFail($recipientId);

        if ($recipient->event->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $eInviteUrl = route('einvite.show', $recipient->unique_token);

        return QrCode::size(250)
                     ->generate($eInviteUrl); 
    }
}
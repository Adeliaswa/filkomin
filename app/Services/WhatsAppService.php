<?php

namespace App\Services;

use App\Models\EventGuest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected string $apiEndpoint;
    protected string $apiKey;

    public function __construct()
    {
        $this->apiEndpoint = env('WHATSAPP_API_ENDPOINT');
        $this->apiKey = env('WHATSAPP_API_KEY');
    }

    /**
     * Kirim undangan WhatsApp via Fonnte
     */
    public function sendInvitation(EventGuest $guest): bool
    {
        // =========================
        // FORMAT NOMOR (WAJIB 628xxx)
        // =========================
        $targetPhone = preg_replace('/\D/', '', $guest->whatsapp);

        if (str_starts_with($targetPhone, '0')) {
            $targetPhone = '62' . substr($targetPhone, 1);
        }

        // =========================
        // LINK UNDANGAN & PDF
        // =========================
        $invitationLink = route('einvite.show', $guest->invitation_token);
        $pdfLink        = route('einvite.pdf',  $guest->invitation_token);

        // =========================
        // PESAN WHATSAPP
        // =========================
        $message =
            "Halo Yth. {$guest->name},\n\n" .
            "Anda diundang ke acara:\n" .
            "*{$guest->event->title}*\n\n" .
            "📅 Tanggal: {$guest->event->date}\n" .
            "📍 Lokasi: {$guest->event->location}\n\n" .
            "👉 Buka undangan:\n{$invitationLink}\n\n" .
            "📄 Download PDF:\n{$pdfLink}\n\n" .
            "Terima kasih.";

        try {
            $response = Http::withHeaders([
                // ⚠️ FONNTE TIDAK PAKAI "Bearer"
                'Authorization' => $this->apiKey,
            ])->post($this->apiEndpoint, [
                'target'  => $targetPhone,
                'message' => $message,
            ]);

            Log::info('Fonnte HTTP Status', [
                'status' => $response->status()
            ]);

            Log::info('Fonnte Response', [
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                $body = $response->json();

                // Fonnte kadang HTTP 200 tapi status=false
                if (isset($body['status']) && $body['status'] === false) {
                    Log::error('Fonnte Rejected', [
                        'reason' => $body['reason'] ?? 'Unknown'
                    ]);
                    return false;
                }

                return true;
            }

            return false;

        } catch (\Throwable $e) {
            Log::error('Fonnte Exception', [
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
}

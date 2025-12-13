<?php

namespace App\Services;

use App\Models\Recipient;
use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    protected $apiEndpoint;
    protected $apiKey;

    public function __construct()
    {
        $this->apiEndpoint = env('WHATSAPP_API_ENDPOINT');
        $this->apiKey = env('WHATSAPP_API_KEY');
    }

    public function sendInvitation(Recipient $recipient, string $invitationLink): bool
    {
        $targetPhone = $recipient->phone_wa;
        $message = "Halo Yth. {$recipient->name}, Anda diundang ke acara {$recipient->event->name}. Silakan konfirmasi kehadiran Anda: {$invitationLink}";

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->apiKey,
            ])->post($this->apiEndpoint, [
                'target' => $targetPhone,
                'message' => $message,
            ]);

            \Log::warning("Fonnte Status: " . $response->status());
            \Log::warning("Fonnte Body: " . $response->body());

            if ($response->successful()) {
                $body = $response->json();
                
                if (isset($body['status']) && $body['status'] === false) {
                    \Log::error("Fonnte Ditolak: " . ($body['reason'] ?? 'Alasan tidak diketahui'));
                    return false;
                }
                
                return true;
            }

            return false;

        } catch (\Exception $e) {
            \Log::error("WA API Error for {$recipient->name}: " . $e->getMessage());
            return false;
        }
    }
}
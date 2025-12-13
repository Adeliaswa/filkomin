<?php

namespace App\Jobs;

use App\Models\Recipient;
use App\Services\WhatsAppService;
use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
// use Illuminate\Queue\InteractsWithQueue;
// use Illuminate\Queue\SerializesModels;

class SendInvitationWaNotification
{
    use Dispatchable;
    
    public $timeout = 60;
    public $tries = 3;
    protected $recipient;

    public function __construct(Recipient $recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * Logic pengiriman pesan WhatsApp ada di sini.
     */
    public function handle(WhatsAppService $waService): void
    {
        try {
            $invitationLink = route('einvite.show', $this->recipient->token);
            \Log::info("WA Link Dibuat untuk {$this->recipient->name}: " . $invitationLink);
            $waService->sendInvitation($this->recipient, $invitationLink);
        } catch (\Exception $e){
            \Log::error("Gagal mengirim WA. Error: " . $e->getMessage());
        }
    }
}
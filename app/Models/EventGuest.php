<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventGuest extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'whatsapp',

        'invitation_token',
        'attendance_token',

        'rsvp_status',
        'rsvp_notes',
        'rsvp_pax',

        'attended_at',
    ];

    protected $casts = [
        'attended_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    /**
     * Apakah tamu sudah check-in
     */
    public function hasAttended(): bool
    {
        return !is_null($this->attended_at);
    }

    /**
     * Nomor WhatsApp siap kirim (format 628xxxx)
     */
    public function whatsappForWa(): ?string
    {
        if (!$this->whatsapp) {
            return null;
        }

        // hapus semua selain angka
        $phone = preg_replace('/\D/', '', $this->whatsapp);

        // 08xxx -> 628xxx
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        return $phone;
    }
}

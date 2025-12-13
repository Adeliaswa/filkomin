<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Event;

class StoreRecipientRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (!auth()->check()) {
            return false;
        }

        $eventId = $this->input('event_id');
        
        return Event::where('id', $eventId)
                    ->where('user_id', auth()->id())
                    ->exists();
    }

    public function rules(): array
    {
        return [
            'event_id' => 'required|exists:events,id', 
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'details' => 'nullable|string',
            'phone_wa' => 'required|string|max:15',
        ];
    }
    
    public function messages(): array
    {
        return [
            'event_id.required' => 'Event ID tidak ditemukan.',
            'event_id.exists' => 'Event yang dituju tidak valid.',
            'name.required' => 'Nama Tamu wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ];
    }
}
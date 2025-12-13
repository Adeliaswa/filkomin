<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Event;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        if (!auth()->check()) {
            return false;
        }

        $eventId = $this->route('event');
        $event = Event::find($eventId);
        return $event && $event->user_id === auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'template_id' => 'required|exists:templates,id',
        ];
    }
    
    /**
     * Opsional: Pesan kesalahan kustom jika validasi gagal.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama Event wajib diisi.',
            'date.required' => 'Tanggal Acara wajib diisi.',
            'time.required' => 'Waktu Acara wajib diisi.',
            'location.required' => 'Lokasi Event wajib diisi.',
            'template_id.required' => 'Anda harus memilih Template E-vite.',
        ];
    }
}
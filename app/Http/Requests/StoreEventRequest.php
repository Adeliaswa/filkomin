<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
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
            'date.date' => 'Format tanggal tidak valid.',
            'time.required' => 'Waktu Acara wajib diisi.',
            'time.date_format' => 'Format waktu harus HH:MM (misal: 14:30).',
            'location.required' => 'Lokasi Event wajib diisi.',
            'template_id.required' => 'Anda harus memilih Template E-vite.',
            'template_id.exists' => 'Template yang dipilih tidak valid.',
        ];
    }
}
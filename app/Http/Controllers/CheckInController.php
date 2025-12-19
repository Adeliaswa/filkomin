<?php

namespace App\Http\Controllers;

use App\Models\EventGuest;
use Carbon\Carbon;

class CheckInController extends Controller
{
    /**
     * Check-in tamu menggunakan attendance_token (QR Code)
     * URL: /checkin/{token}
     */
    public function checkin(string $token)
    {
        $guest = EventGuest::where('attendance_token', $token)->first();

        // token tidak valid
        if (!$guest) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token tamu tidak valid.',
            ], 404);
        }

        // sudah check-in
        if ($guest->attended_at) {
            return response()->json([
                'status' => 'already_checked_in',
                'message' => 'Tamu sudah check-in pada pukul ' .
                    Carbon::parse($guest->attended_at)->format('H:i'),
                'guest' => $guest->name,
            ], 200);
        }

        // simpan waktu check-in
        $guest->update([
            'attended_at' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Check-in berhasil! Selamat datang, ' . $guest->name . '.',
            'guest' => $guest->name,
            'time' => Carbon::now()->format('H:i'),
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckInController extends Controller
{
    public function checkin(string $token)
    {
        $recipient = Recipient::where('token', $token)->first();

        if (!$recipient) {
            return response()->json(['message' => 'Token Tamu tidak valid.'], 404);
        }

        if ($recipient->checkin_time) {
            $checkinTime = Carbon::parse($recipient->checkin_time)->format('H:i');
            return response()->json(['message' => 'Tamu ini sudah check-in pada pukul ' . $checkinTime], 200);
        }

        $recipient->checkin_time = Carbon::now();
        $recipient->save();

        return response()->json(['message' => 'Check-in berhasil! Selamat datang, ' . $recipient->name . '.'], 200);
    }
}
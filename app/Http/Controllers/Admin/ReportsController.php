<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    private function dateRange(Request $request): array
    {
        // default: 30 hari terakhir
        $from = $request->input('from')
            ? Carbon::parse($request->input('from'))->startOfDay()
            : now()->subDays(30)->startOfDay();

        $to = $request->input('to')
            ? Carbon::parse($request->input('to'))->endOfDay()
            : now()->endOfDay();

        return [$from, $to];
    }

   public function dashboard(Request $request)
{
    [$from, $to] = $this->dateRange($request);

    return view('admin.reports.dashboard', [
        // Total event dibuat
        'totalEvents' => DB::table('events')
            ->whereBetween('created_at', [$from, $to])
            ->count(),

        // Total undangan
        'totalRecipients' => DB::table('recipients')
            ->whereBetween('created_at', [$from, $to])
            ->count(),

        // Total RSVP masuk
        'totalRsvp' => DB::table('rsvp_responses')
            ->whereBetween('created_at', [$from, $to])
            ->count(),

        // Undangan yang BELUM RSVP
        'rsvpPending' => DB::table('recipients')
            ->whereNotIn('id', function ($q) {
                $q->select('recipient_id')->from('rsvp_responses');
            })
            ->whereBetween('created_at', [$from, $to])
            ->count(),

        // Event Organizer aktif
        'activeEO' => DB::table('users')
            ->where('role', 'eo')
            ->count(),

        'from' => $from,
        'to' => $to,
    ]);
}
}
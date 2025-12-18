<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventApprovalController extends Controller
{
    /**
     * Display event list based on approval status
     */
public function index($status = 'pending')
{
    $allowedStatus = ['pending', 'revision', 'approved', 'rejected'];

    if (!in_array($status, $allowedStatus)) {
        abort(404);
    }

    $events = Event::where('status', $status)
        ->latest()
        ->paginate(10);

    return view('admin.event-approval.index', compact('events', 'status'));
}


    /**
     * Approve event
     */
    public function approve(Event $event)
    {
        $event->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'Event approved successfully.');
    }

    /**
     * Reject event
     */
    public function reject(Event $event)
    {
        $event->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', 'Event rejected.');
    }

    /**
     * Request revision for event
     */
    public function revision(Event $event)
    {
        $event->update([
            'status' => 'revision'
        ]);

        return back()->with('success', 'Revision requested.');
    }
}

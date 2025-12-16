@extends('layouts.admin')

@section('title', 'Event Approval | FILKOMIN')
@section('page-title', 'Event Approval')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-semibold mb-1">
        Event Approval
    </h1>
    <p class="text-sm text-gray-500">
        Review and manage event submissions from Event Organizers
    </p>
</div>

<div class="bg-white rounded-xl shadow-sm border overflow-hidden">

    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b">
            <tr class="text-left text-gray-600">
                <th class="px-6 py-3">Event</th>
                <th class="px-6 py-3">Organizer</th>
                <th class="px-6 py-3">Date</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3 text-right">Action</th>
            </tr>
        </thead>
        <tbody>

        @forelse ($events as $event)
            <tr class="border-b last:border-0">
                <td class="px-6 py-4 font-medium">
                    {{ $event->title }}
                </td>
                <td class="px-6 py-4">
                    {{ $event->organizer ?? '-' }}
                </td>
                <td class="px-6 py-4">
                    {{ $event->event_time?->format('d M Y') ?? '-' }}
                </td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded text-xs font-medium
                        @if ($event->status === 'pending') bg-yellow-100 text-yellow-700
                        @elseif ($event->status === 'approved') bg-green-100 text-green-700
                        @elseif ($event->status === 'rejected') bg-red-100 text-red-700
                        @elseif ($event->status === 'revision') bg-orange-100 text-orange-700
                        @endif
                    ">
                        {{ ucfirst($event->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right space-x-2">

                    @if ($event->status === 'pending')
                        <form action="{{ route('admin.events.approve', $event->id) }}"
                              method="POST" class="inline">
                            @csrf
                            <button class="text-green-600 hover:underline text-xs">
                                Approve
                            </button>
                        </form>

                        <form action="{{ route('admin.events.revision', $event->id) }}"
                              method="POST" class="inline">
                            @csrf
                            <button class="text-orange-600 hover:underline text-xs">
                                Revision
                            </button>
                        </form>

                        <form action="{{ route('admin.events.reject', $event->id) }}"
                              method="POST" class="inline">
                            @csrf
                            <button class="text-red-600 hover:underline text-xs">
                                Reject
                            </button>
                        </form>
                    @else
                        <span class="text-xs text-gray-400">No action</span>
                    @endif

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                    No events found for this status.
                </td>
            </tr>
       @endforelse

        </tbody>
    </table>
</div>

@endsection

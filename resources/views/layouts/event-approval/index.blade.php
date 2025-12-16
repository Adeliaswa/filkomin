@extends('layouts.admin')

@section('title', 'Event Approval | FILKOMIN')
@section('page-title', 'Event Approval')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-semibold mb-1 capitalize">
        {{ str_replace('-', ' ', $status ?? 'pending') }} Events
    </h1>
    <p class="text-sm text-gray-500">
        Review and manage event submissions
    </p>
</div>

<div class="bg-white rounded-xl shadow-sm border overflow-hidden">

    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500">
            <tr>
                <th class="px-6 py-3 text-left">Event</th>
                <th class="px-6 py-3">Organizer</th>
                <th class="px-6 py-3">Date</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3 text-right">Action</th>
            </tr>
        </thead>

        <tbody class="divide-y">

        @forelse ($events as $event)
            <tr>
                <td class="px-6 py-4 font-medium">
                    {{ $event->title }}
                </td>
                <td class="px-6 py-4">
                    {{ $event->organizer }}
                </td>
                <td class="px-6 py-4">
                    {{ $event->event_time?->format('d M Y') }}
                </td>
                <td class="px-6 py-4 capitalize">
                    {{ $event->status }}
                </td>
                <td class="px-6 py-4 text-right space-x-2">

                    @if ($event->status === 'pending')
                        <form method="POST" action="{{ route('admin.events.approve', $event) }}" class="inline">
                            @csrf
                            <button class="px-3 py-1 text-xs rounded bg-green-600 text-white">
                                Approve
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.events.revision', $event) }}" class="inline">
                            @csrf
                            <button class="px-3 py-1 text-xs rounded bg-yellow-500 text-white">
                                Revision
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.events.reject', $event) }}" class="inline">
                            @csrf
                            <button class="px-3 py-1 text-xs rounded bg-red-600 text-white">
                                Reject
                            </button>
                        </form>
                    @endif

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                    No events found.
                </td>
            </tr>
        @endforelse

        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $events->links() }}
</div>

@endsection

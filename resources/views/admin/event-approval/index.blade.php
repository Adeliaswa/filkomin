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

    <table class="w-full text-sm table-fixed">
        <thead class="bg-gray-50 text-gray-500">
            <tr>
                <th class="px-6 py-3 text-left w-1/3">Event</th>
                <th class="px-6 py-3 text-center w-1/3">Status</th>
                <th class="px-6 py-3 text-center w-1/3">Action</th>
            </tr>
        </thead>

        <tbody class="divide-y">
        @forelse ($events as $event)
            <tr>
                {{-- EVENT --}}
                <td class="px-6 py-3 font-medium text-left">
                    {{ $event->title }}
                </td>

                {{-- STATUS --}}
                <td class="px-6 py-3">
                    <div class="flex items-center justify-center capitalize">
                        {{ $event->status }}
                    </div>
                </td>

                {{-- ACTION --}}
                <td class="px-6 py-3">
                    <div class="flex items-center justify-center gap-2 min-h-[28px]">

                        @if ($event->status === 'pending')
                            <form method="POST" action="{{ route('admin.events.approve', $event) }}">
                                @csrf
                                <button class="px-3 py-1 text-xs rounded bg-green-600 text-white">
                                    Approve
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.events.revision', $event) }}">
                                @csrf
                                <button class="px-3 py-1 text-xs rounded bg-yellow-500 text-white">
                                    Revision
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.events.reject', $event) }}">
                                @csrf
                                <button class="px-3 py-1 text-xs rounded bg-red-600 text-white">
                                    Reject
                                </button>
                            </form>
                        @else
                            <span class="text-xs text-gray-400">—</span>
                        @endif

                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="px-6 py-8 text-center text-gray-500">
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

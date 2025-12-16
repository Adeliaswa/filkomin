@extends('layouts.admin')

@section('title', 'Admin Dashboard | FILKOMIN')
@section('page-title', 'Dashboard Overview')

@section('content')

<!-- HEADER -->
<div class="mb-8">
    <h1 class="text-2xl font-semibold mb-1">
        System Overview
    </h1>
    <p class="text-sm text-gray-500">
        Monitoring and supervision dashboard for
        <span class="font-semibold text-[#4A3E3E]">FILKOMIN</span>
    </p>
</div>

<!-- SUMMARY CARDS -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

    <div class="bg-white rounded-xl p-6 shadow-sm border">
        <p class="text-xs uppercase tracking-wide text-gray-500">
            Total Users
        </p>
        <h3 class="text-3xl font-semibold mt-2">
            {{ $totalUsers ?? 0 }}
        </h3>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm border">
        <p class="text-xs uppercase tracking-wide text-gray-500">
            Event Organizers
        </p>
        <h3 class="text-3xl font-semibold mt-2">
            {{ $totalOrganizers ?? 0 }}
        </h3>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm border">
        <p class="text-xs uppercase tracking-wide text-gray-500">
            Total Events
        </p>
        <h3 class="text-3xl font-semibold mt-2">
            {{ $totalEvents ?? 0 }}
        </h3>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm border">
        <p class="text-xs uppercase tracking-wide text-gray-500">
            RSVP Submissions
        </p>
        <h3 class="text-3xl font-semibold mt-2">
            {{ $totalRsvp ?? 0 }}
        </h3>
    </div>

</div>

<!-- RECENT EVENTS -->
<div class="bg-white rounded-xl p-6 shadow-sm border">

    <div class="flex items-center justify-between mb-4">
        <h4 class="text-sm font-semibold">
            Recent Event Submissions
        </h4>
        <span class="text-xs text-gray-500">
            Submitted by Event Organizers
        </span>
    </div>

    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-gray-500 border-b">
                <th class="py-2">Event Name</th>
                <th>Status</th>
                <th>Submitted Date</th>
            </tr>
        </thead>
        <tbody>

        @forelse ($recentEvents as $event)
            <tr class="border-b last:border-0">
                <td class="py-3">
                    {{ $event->title }}
                </td>
                <td>
                    <span class="font-medium
                        @if ($event->status === 'pending') text-yellow-600
                        @elseif ($event->status === 'approved') text-green-600
                        @elseif ($event->status === 'rejected') text-red-600
                        @else text-gray-600
                        @endif
                    ">
                        {{ ucfirst($event->status) }}
                    </span>
                </td>
                <td>
                    {{ $event->created_at->format('d M Y') }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="py-6 text-center text-gray-500">
                    No event submissions yet.
                </td>
            </tr>
        @endforelse

        </tbody>
    </table>

</div>

@endsection

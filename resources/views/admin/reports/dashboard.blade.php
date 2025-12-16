@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-semibold">Reports Overview</h1>
        <p class="text-sm text-gray-500">System analytics summary</p>
    </div>

    {{-- Filter --}}
    <form method="GET" class="flex items-center gap-3 bg-white p-4 rounded-lg shadow-sm w-fit">
        <input type="date" name="from"
               value="{{ $from->toDateString() }}"
               class="border rounded-md px-3 py-2 text-sm">

        <span class="text-gray-400">to</span>

        <input type="date" name="to"
               value="{{ $to->toDateString() }}"
               class="border rounded-md px-3 py-2 text-sm">

        <button class="bg-gray-900 text-white px-4 py-2 rounded-md text-sm hover:bg-gray-800">
            Filter
        </button>
    </form>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 text-left">Metric</th>
                    <th class="px-6 py-3 text-right">Value</th>
                </tr>
            </thead>
            <tbody class="divide-y">

                <tr>
                    <td class="px-6 py-4">Total Events</td>
                    <td class="px-6 py-4 text-right font-semibold">
                        {{ $totalEvents }}
                    </td>
                </tr>

                <tr>
                    <td class="px-6 py-4">Total Invitations</td>
                    <td class="px-6 py-4 text-right font-semibold">
                        {{ $totalRecipients }}
                    </td>
                </tr>

                <tr>
                    <td class="px-6 py-4">RSVP Submissions</td>
                    <td class="px-6 py-4 text-right font-semibold">
                        {{ $totalRsvp }}
                    </td>
                </tr>

                <tr>
                    <td class="px-6 py-4">Pending RSVP</td>
                    <td class="px-6 py-4 text-right font-semibold">
                        {{ $rsvpPending }}
                    </td>
                </tr>

                <tr>
                    <td class="px-6 py-4">Active Event Organizers</td>
                    <td class="px-6 py-4 text-right font-semibold">
                        {{ $activeEO }}
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</div>
@endsection

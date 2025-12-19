@extends('layouts.admin')

@section('page-title', 'Event Organizers')

@section('content')
<h1 class="text-xl font-semibold mb-4">Event Organizers</h1>

<table class="w-full bg-white rounded shadow text-sm">
    <thead>
        <tr class="border-b">
            <th class="p-3 text-left">Name</th>
            <th class="p-3 text-left">Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($eos as $eo)
        <tr class="border-b last:border-0">
            <td class="p-3">{{ $eo->name }}</td>
            <td class="p-3">{{ $eo->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

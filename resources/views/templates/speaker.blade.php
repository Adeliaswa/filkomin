<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $event->title }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 text-gray-800 font-sans">

<div class="max-w-3xl mx-auto my-12 bg-white border rounded-xl shadow p-10">

    <div class="mb-6 text-center">
        <h1 class="text-xl font-semibold mb-1">
            Invitation as Speaker
        </h1>
        <p class="text-sm text-gray-500">
            {{ $event->title }}
        </p>
    </div>

    <p class="mb-4">
        Dear <strong>{{ $recipientName }}</strong>,
    </p>

    <p class="mb-6">
        We are honored to invite you as a speaker for the following event:
    </p>

    <table class="w-full text-sm mb-6">
        <tr>
            <td class="py-1 w-1/3 text-gray-500">Event</td>
            <td class="py-1 font-medium">{{ $event->title }}</td>
        </tr>
        <tr>
            <td class="py-1 text-gray-500">Date & Time</td>
            <td class="py-1 font-medium">{{ $event->event_time }}</td>
        </tr>
        <tr>
            <td class="py-1 text-gray-500">Location</td>
            <td class="py-1 font-medium">{{ $event->location }}</td>
        </tr>
        <tr>
            <td class="py-1 text-gray-500">Dresscode</td>
            <td class="py-1 font-medium">{{ $event->dresscode }}</td>
        </tr>
    </table>

    <div class="bg-gray-50 border p-4 rounded text-sm mb-6">
        {{ $event->description }}
    </div>

    <p class="mb-6">
        We would be grateful for your availability and participation.
    </p>

    <p class="mb-10">
        Sincerely,<br>
        <strong>{{ $event->organizer }}</strong>
    </p>

    @include('templates.partials.rsvp')

</div>

</body>
</html>

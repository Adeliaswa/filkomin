<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $event->title }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-[#FBF9F5] text-[#181818] font-serif">

<div class="max-w-3xl mx-auto p-10 bg-white mt-10 shadow">

    <h1 class="text-center text-xl font-bold mb-6">
        UNDANGAN RESMI
    </h1>

    <p>
        Yth. Bapak/Ibu
        <strong>{{ $recipientName ?? 'Nama Tamu' }}</strong>,
    </p>

    <p class="mt-4">
        Dengan hormat, kami mengundang Bapak/Ibu untuk menghadiri acara:
    </p>

    <table class="mt-4 text-sm">
        <tr>
            <td class="pr-4">Nama Acara</td>
            <td>: {{ $event->title }}</td>
        </tr>
        <tr>
            <td>Waktu</td>
            <td>: {{ $event->event_time ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tempat</td>
            <td>: {{ $event->location ?? '-' }}</td>
        </tr>
        <tr>
            <td>Dresscode</td>
            <td>: {{ $event->dresscode ?? '-' }}</td>
        </tr>
    </table>

    <p class="mt-6">
        Atas perhatian Bapak/Ibu, kami ucapkan terima kasih.
    </p>

    <p class="mt-10 text-right">
        Hormat kami,<br>
        {{ $event->organizer ?? $event->organizer_name ?? 'Panitia' }}
    </p>

    {{-- RSVP hanya muncul kalau sudah final --}}
    @if(!empty($showRsvp))
        @include('templates.partials.rsvp')
    @endif

</div>

</body>
</html>

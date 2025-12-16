<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $event->title }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-[#FAF9F7] text-[#181818] font-sans">

<div class="max-w-3xl mx-auto my-10 bg-white rounded-2xl shadow p-8">

    <h1 class="text-2xl font-bold text-center text-[#4A3E3E] mb-2">
        {{ $event->title }}
    </h1>

    <p class="text-center text-sm text-gray-500 mb-6">
        Organized by {{ $event->organizer }}
    </p>

    <p class="mb-4">
        Halo <strong>{{ $recipientName }}</strong> 👋
    </p>

    <p class="mb-6">
        Kami mengundang kamu untuk hadir dalam kegiatan berikut:
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm mb-6">
        <div>
            <p class="text-gray-500">📅 Tanggal & Waktu</p>
            <p class="font-medium">{{ $event->event_time }}</p>
        </div>
        <div>
            <p class="text-gray-500">📍 Lokasi</p>
            <p class="font-medium">{{ $event->location }}</p>
        </div>
        <div>
            <p class="text-gray-500">👕 Dresscode</p>
            <p class="font-medium">{{ $event->dresscode }}</p>
        </div>
    </div>

    <div class="bg-[#EEE9DF] p-4 rounded-lg text-sm mb-6">
        {{ $event->description }}
    </div>

    <p class="mb-6">
        Jangan sampai kelewatan ya!  
        Kami tunggu kehadiranmu 🙌
    </p>

    @include('templates.partials.rsvp')

</div>

</body>
</html>

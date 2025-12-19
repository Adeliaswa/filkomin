<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $event->title }}</title>
    @vite('resources/css/app.css')
    {{-- Menambahkan CDN Tailwind agar preview di admin langsung muncul stylenya tanpa perlu compile --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#FAF9F7] text-[#181818] font-sans">

<div class="max-w-3xl mx-auto my-10 bg-white rounded-2xl shadow-lg p-8 border border-gray-100">

    <h1 class="text-2xl font-bold text-center text-[#4A3E3E] mb-2 uppercase tracking-tight">
        {{ $event->title }}
    </h1>

    <p class="text-center text-sm text-gray-500 mb-6">
        {{-- Perbaikan: organizer -> organizer_name --}}
        Organized by {{ $event->organizer_name }}
    </p>

    <p class="mb-4 text-lg">
        {{-- Perbaikan: $recipientName tidak dikirim di Controller, gunakan $guest->name --}}
        Halo <strong>{{ $guest->name ?? 'Nama Tamu Preview' }}</strong> 👋
    </p>

    <p class="mb-6 text-gray-600">
        Kami mengundang kamu untuk hadir dalam kegiatan berikut:
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm mb-8">
        <div class="bg-gray-50 p-3 rounded-xl">
            <p class="text-gray-400 uppercase text-[10px] font-bold tracking-widest">📅 Tanggal & Waktu</p>
            {{-- Perbaikan: event_time -> start_time & format date --}}
            <p class="font-medium text-gray-800">
                {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }} <br>
                Pukul {{ $event->start_time }} WIB
            </p>
        </div>
        <div class="bg-gray-50 p-3 rounded-xl">
            <p class="text-gray-400 uppercase text-[10px] font-bold tracking-widest">📍 Lokasi</p>
            <p class="font-medium text-gray-800">{{ $event->location }}</p>
        </div>
        <div class="bg-gray-50 p-3 rounded-xl">
            <p class="text-gray-400 uppercase text-[10px] font-bold tracking-widest">👕 Dresscode</p>
            {{-- Perbaikan: dresscode -> dress_code --}}
            <p class="font-medium text-gray-800">{{ $event->dress_code ?? 'Bebas Rapi' }}</p>
        </div>
    </div>

    {{-- Perbaikan: description -> notes --}}
    <div class="bg-[#EEE9DF] p-5 rounded-xl text-sm mb-8 text-[#4A3E3E] leading-relaxed">
        <p class="font-bold mb-1">Catatan:</p>
        {{ $event->notes }}
    </div>

    <p class="mb-8 text-center text-gray-700">
        Jangan sampai kelewatan ya! <br>
        Kami tunggu kehadiranmu 🙌
    </p>

    <hr class="mb-8 border-dashed">

    {{-- RSVP Section (Preview Mode) --}}
    <div class="bg-white border-2 border-[#EEE9DF] p-6 rounded-2xl">
        <h3 class="font-bold text-center mb-4 text-[#4A3E3E]">Konfirmasi Kehadiran</h3>
        <div class="flex flex-col gap-3">
            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                <span class="text-sm font-medium italic">Status RSVP:</span>
                <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded">Pending (Preview)</span>
            </div>
            <button class="w-full py-3 bg-[#4A3E3E] text-white rounded-xl font-bold text-sm shadow-md opacity-50 cursor-not-allowed">
                Buka Form RSVP
            </button>
        </div>
    </div>

</div>

<footer class="text-center pb-10">
    <p class="text-[10px] text-gray-400 uppercase tracking-[0.2em]">Powered by FILKOMIN System</p>
</footer>

</body>
</html>
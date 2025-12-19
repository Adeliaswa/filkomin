<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    {{-- Perbaikan: $event->title sudah benar --}}
    <title>{{ $event->title }}</title>
    
    {{-- Catatan: Jika menggunakan Tailwind (app.css), pastikan file sudah di-compile. 
         Jika preview admin masih berantakan, kamu bisa ganti sementara ke CDN Tailwind --}}
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script> {{-- Tambahan CDN agar preview pasti rapi --}}
</head>

<body class="bg-[#FBF9F5] text-[#181818] font-serif">

<div class="max-w-3xl mx-auto p-10 bg-white mt-10 shadow border border-gray-100">

    <h1 class="text-center text-xl font-bold mb-6 tracking-widest">
        UNDANGAN RESMI
    </h1>

    <p>
        Yth. Bapak/Ibu
        {{-- Perbaikan: Sesuaikan dengan variabel $guest dari Controller --}}
        <strong>{{ $guest->name ?? 'Nama Tamu Preview' }}</strong>,
    </p>

    <p class="mt-4 text-gray-700">
        Dengan hormat, kami mengundang Bapak/Ibu untuk menghadiri acara:
    </p>

    <table class="mt-6 text-sm w-full border-separate border-spacing-y-2">
        <tr>
            <td class="w-32 font-semibold">Nama Acara</td>
            <td>: {{ $event->title }}</td>
        </tr>
        <tr>
            <td class="font-semibold">Hari, Tanggal</td>
            {{-- Perbaikan: Menggunakan format Carbon agar rapi --}}
            <td>: {{ \Carbon\Carbon::parse($event->date)->format('l, d F Y') }}</td>
        </tr>
        <tr>
            <td class="font-semibold">Waktu</td>
            {{-- Perbaikan: Sesuaikan dengan start_time dari Controller --}}
            <td>: {{ $event->start_time }} s/d {{ $event->end_time ?? 'Selesai' }} WIB</td>
        </tr>
        <tr>
            <td class="font-semibold">Tempat</td>
            <td>: {{ $event->location ?? '-' }}</td>
        </tr>
        <tr>
            <td class="font-semibold">Dresscode</td>
            {{-- Perbaikan: Sesuaikan dengan dress_code (pake underscore) --}}
            <td>: {{ $event->dress_code ?? '-' }}</td>
        </tr>
    </table>

    <p class="mt-8 text-gray-700 italic">
        "{{ $event->notes ?? 'Partisipasi Bapak/Ibu merupakan kehormatan bagi kami.' }}"
    </p>

    <p class="mt-8">
        Atas perhatian Bapak/Ibu, kami ucapkan terima kasih.
    </p>

    <div class="mt-12 text-right">
        <p>Hormat kami,</p>
        {{-- Perbaikan: Sesuaikan dengan organizer_name --}}
        <p class="font-bold mt-4 uppercase underline">{{ $event->organizer_name ?? 'Panitia Penyelenggara' }}</p>
        <p class="text-xs text-gray-500">{{ $event->organizer_unit ?? '' }}</p>
    </div>

    {{-- RSVP Section --}}
    <div class="mt-10 pt-6 border-t border-dashed">
        <h3 class="font-bold mb-2">Konfirmasi Kehadiran</h3>
        <p class="text-xs text-gray-500 mb-4">*Silakan melakukan konfirmasi melalui sistem undangan digital ini.</p>
        
        <div class="bg-gray-50 p-4 rounded text-sm border border-gray-200">
            {{-- Karena ini preview, kita buat dummy statis saja agar tidak error @include --}}
            <label class="block mb-2 font-medium">Status Kehadiran:</label>
            <div class="flex gap-4">
                <span class="px-3 py-1 bg-white border rounded">Hadir</span>
                <span class="px-3 py-1 bg-white border rounded">Tidak Hadir</span>
            </div>
            <button class="mt-4 bg-black text-white px-4 py-2 rounded text-xs opacity-50 cursor-not-allowed">
                Kirim RSVP (Preview Only)
            </button>
        </div>
    </div>

</div>

<div class="text-center mt-6 mb-10 text-xs text-gray-400">
    &copy; {{ date('Y') }} FILKOMIN Invitation System
</div>

</body>
</html>
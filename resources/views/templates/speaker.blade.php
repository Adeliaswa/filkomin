<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Speaker Invitation - {{ $event->title }}</title>
    @vite('resources/css/app.css')
    {{-- CDN Tailwind untuk rendering cepat di preview --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">

<div class="max-w-3xl mx-auto my-12 bg-white border border-gray-200 rounded-xl shadow-lg p-10 relative overflow-hidden">
    
    {{-- Aksen dekoratif tipis untuk kesan profesional --}}
    <div class="absolute top-0 left-0 w-full h-1 bg-blue-600"></div>

    <div class="mb-10 text-center">
        <h1 class="text-2xl font-serif font-bold text-gray-900 mb-1 tracking-tight">
            Official Invitation as Speaker
        </h1>
        <p class="text-sm text-blue-600 font-medium uppercase tracking-widest">
            {{ $event->category ?? 'Academic Event' }}
        </p>
    </div>

    <p class="mb-4 text-lg">
        Dear <strong>{{ $guest->name ?? 'Distinguished Speaker' }}</strong>,
    </p>

    <p class="mb-6 leading-relaxed text-gray-600">
        We are deeply honored to invite you to share your expertise and insights as a speaker for the following event:
    </p>

    <div class="bg-white border border-gray-100 rounded-lg p-2 mb-8">
        <table class="w-full text-sm">
            <tr class="border-b border-gray-50">
                <td class="py-3 px-4 w-1/3 text-gray-400 uppercase text-[10px] font-bold">Event Title</td>
                <td class="py-3 px-4 font-semibold text-gray-800">{{ $event->title }}</td>
            </tr>
            <tr class="border-b border-gray-50">
                <td class="py-3 px-4 text-gray-400 uppercase text-[10px] font-bold">Date & Time</td>
                {{-- Perbaikan: event_time -> start_time & format date --}}
                <td class="py-3 px-4 font-semibold text-gray-800">
                    {{ \Carbon\Carbon::parse($event->date)->format('l, d F Y') }} <br>
                    Starts at {{ $event->start_time }} WIB
                </td>
            </tr>
            <tr class="border-b border-gray-50">
                <td class="py-3 px-4 text-gray-400 uppercase text-[10px] font-bold">Venue Location</td>
                <td class="py-3 px-4 font-semibold text-gray-800">{{ $event->location }}</td>
            </tr>
            <tr>
                <td class="py-3 px-4 text-gray-400 uppercase text-[10px] font-bold">Expected Dresscode</td>
                {{-- Perbaikan: dresscode -> dress_code --}}
                <td class="py-3 px-4 font-semibold text-gray-800">{{ $event->dress_code ?? 'Formal / Business Attire' }}</td>
            </tr>
        </table>
    </div>

    {{-- Perbaikan: description -> notes --}}
    <div class="bg-blue-50 border-l-4 border-blue-600 p-5 rounded text-sm mb-8 text-blue-900">
        <p class="font-bold mb-2 uppercase text-[10px]">Session Description & Notes:</p>
        <p class="italic leading-relaxed">"{{ $event->notes }}"</p>
    </div>

    <p class="mb-6 text-gray-600">
        We believe your contribution will be invaluable to the success of this event. We would be grateful for your availability and participation.
    </p>

    <div class="mb-12 pt-4">
        <p class="text-gray-500 mb-1">Sincerely,</p>
        {{-- Perbaikan: organizer -> organizer_name --}}
        <p class="font-bold text-gray-900 text-lg">{{ $event->organizer_name }}</p>
        <p class="text-sm text-gray-400">{{ $event->organizer_unit ?? 'Event Committee' }}</p>
    </div>

    <hr class="mb-8 border-gray-100">

    {{-- RSVP Section (Preview Mode) --}}
    <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
        <h3 class="text-sm font-bold text-gray-700 mb-4 text-center uppercase tracking-wider">Speaker Confirmation</h3>
        <div class="flex flex-col sm:flex-row gap-3">
            <button class="flex-1 py-2 bg-blue-600 text-white rounded font-bold text-xs shadow opacity-50 cursor-not-allowed">
                ACCEPT INVITATION
            </button>
            <button class="flex-1 py-2 bg-white border border-gray-300 text-gray-500 rounded font-bold text-xs opacity-50 cursor-not-allowed">
                DECLINE
            </button>
        </div>
        <p class="text-[10px] text-gray-400 mt-4 text-center italic">*This is a preview. Action buttons are disabled.</p>
    </div>

</div>

<footer class="text-center pb-12 text-[10px] text-gray-400 font-mono">
    &copy; {{ date('Y') }} FILKOMIN DIGITAL INVITATION SYSTEM
</footer>

</body>
</html>
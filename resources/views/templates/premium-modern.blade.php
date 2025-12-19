<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->title }}</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-slate-100 min-h-screen text-slate-900">

    <div class="max-w-2xl mx-auto py-12 px-6">
        <div class="glass-card rounded-[2rem] shadow-2xl overflow-hidden bg-white">
            <div class="h-48 bg-slate-900 flex items-center justify-center relative overflow-hidden text-center p-6">
                <div class="absolute inset-0 opacity-20">
                    <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <path d="M0 0 L100 100 M100 0 L0 100" stroke="white" stroke-width="0.5"/>
                    </svg>
                </div>
                <h1 class="text-white text-3xl font-extrabold tracking-tighter z-10 uppercase">
                    {{ $event->title }}
                </h1>
            </div>

            <div class="p-8 md:p-12">
                <div class="mb-10">
                    <p class="text-slate-400 text-sm uppercase tracking-widest mb-2">Exclusive Invitation for</p>
                    <h2 class="text-3xl font-extrabold text-slate-900 border-l-4 border-slate-900 pl-4">
                        {{ $guest->name ?? $recipientName ?? 'Valued Guest' }}
                    </h2>
                </div>

                <p class="text-slate-600 leading-relaxed mb-8">
                    We are pleased to inform you that you are cordially invited to join us for an exceptional experience. Please find the event details below:
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-10">
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Date</span>
                        <p class="font-bold text-slate-800">{{ \Carbon\Carbon::parse($event->date)->format('D, d M Y') }}</p>
                    </div>
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Time</span>
                        <p class="font-bold text-slate-800">{{ $event->start_time }} WIB</p>
                    </div>
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 md:col-span-2">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Venue</span>
                        <p class="font-bold text-slate-800">{{ $event->location }}</p>
                    </div>
                </div>

                <div class="mb-10">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="h-[1px] flex-1 bg-slate-200"></div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Special Notes</span>
                        <div class="h-[1px] flex-1 bg-slate-200"></div>
                    </div>
                    <p class="text-center text-slate-500 text-sm italic italic">
                        "{{ $event->notes ?? 'Looking forward to your presence.' }}"
                    </p>
                </div>

                <div class="mt-12 pt-8 border-t border-slate-100">
                    <div class="bg-slate-900 rounded-2xl p-6 text-center shadow-lg">
                        <p class="text-slate-400 text-xs mb-4 uppercase tracking-widest">Confirm Your Attendance</p>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <button class="flex-1 bg-white text-slate-900 py-3 rounded-xl font-bold text-sm hover:bg-slate-100 transition-all opacity-50 cursor-not-allowed">
                                YES, I'LL BE THERE
                            </button>
                            <button class="flex-1 border border-slate-700 text-slate-400 py-3 rounded-xl font-bold text-sm opacity-50 cursor-not-allowed">
                                REGRETFULLY DECLINE
                            </button>
                        </div>
                        <p class="text-[10px] text-slate-500 mt-4 italic">*Preview Mode: Buttons are disabled</p>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-slate-50 text-center border-t border-slate-100">
                <p class="text-xs text-slate-400 mb-1 leading-relaxed">
                    Sincerely,<br>
                    <span class="font-bold text-slate-600 uppercase tracking-widest text-[14px]">{{ $event->organizer_name }}</span>
                </p>
            </div>
        </div>

        <div class="text-center mt-8">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.4em]">FILKOMIN PREMIUM SYSTEM</p>
        </div>
    </div>

</body>
</html>
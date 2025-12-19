<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Perbaikan: $event->name jadi $event->title --}}
    <title>Undangan {{ $event->title }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { background-color: #f7f7f7; font-family: 'Georgia', serif; color: #333; }
        .invitation-card { max-width: 600px; margin: 50px auto; padding: 30px; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); background-color: #ffffff; border-top: 5px solid #007bff; }
        h1, h2, h3 { color: #007bff; font-weight: 700; }
        .to-text { font-size: 1.5rem; margin-top: 20px; font-style: italic; }
    </style>
</head>
<body>

    <div class="container">
        <div class="invitation-card text-center">
            
            {{-- Perbaikan: $event->name jadi $event->title --}}
            <h1 class="mb-4">{{ $event->title }}</h1>

            {{-- Perbaikan: variabel $recipientName tidak ada, ganti ke $guest->name --}}
            @if (isset($guest->name))
                <p class="to-text">
                    Kepada Yth: <br>
                    <span class="d-block mt-2">{{ $guest->name }}</span>
                </p>
                <hr>
            @endif

            <p class="mt-4">Dengan segala kerendahan hati, kami mengundang Anda untuk hadir dalam acara kami:</p>
            
            <div class="mt-5">
                <h3>Kapan</h3>
                <p class="lead">
                    <strong>{{ \Carbon\Carbon::parse($event->date)->format('l, d F Y') }}</strong>
                    <br>
                    {{-- Perbaikan: $event->time jadi $event->start_time --}}
                    Pukul {{ $event->start_time }} WIB
                </p>
            </div>

            <div class="mt-5">
                <h3>Dimana</h3>
                <p class="lead">
                    <strong>{{ $event->location }}</strong>
                </p>
            </div>
            
            <div class="mt-5">
                <h3>Pesan Khusus</h3>
                {{-- Perbaikan: $event->description jadi $event->notes --}}
                <p class="text-muted">{{ nl2br($event->notes ?? 'Tidak ada pesan khusus') }}</p>
            </div>

            <div class="mt-5 p-4 border rounded text-start">
                <h3>Konfirmasi Kehadiran (RSVP)</h3>
                
                {{-- Perbaikan: Menggunakan $guest dan pengecekan rsvpResponse --}}
                @if (isset($guest->rsvpResponse))
                    <div class="alert alert-info small">
                        Status Anda saat ini: <strong>{{ ucfirst($guest->rsvpResponse->status) }}</strong>
                    </div>
                @endif

                {{-- Link RSVP diarahkan ke '#' dulu karena ini hanya preview --}}
                <form action="#" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Status:</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="statusHadir" value="hadir" required>
                                <label class="form-check-label" for="statusHadir">Hadir</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pax" class="form-label">Jumlah Kehadiran (Pax)</label>
                        <input type="number" name="pax" id="pax" class="form-control" min="1" value="1">
                    </div>

                    <button type="submit" class="btn btn-success w-100" disabled>Kirim (Preview Only)</button>
                </form>
            </div>

            <footer class="mt-5 border-top pt-3">
                <p class="text-secondary">&copy; {{ date('Y') }} E-vite by {{ config('app.name') }}</p>
            </footer>
        </div>
    </div>

</body>
</html>
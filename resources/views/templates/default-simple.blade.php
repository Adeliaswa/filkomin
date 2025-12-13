<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Undangan {{ $event->name }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Georgia', serif;
            color: #333;
        }
        .invitation-card {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            background-color: #ffffff;
            border-top: 5px solid #007bff; 
        }
        h1, h2, h3 {
            color: #007bff;
            font-weight: 700;
        }
        .to-text {
            font-size: 1.5rem;
            margin-top: 20px;
            font-style: italic;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="invitation-card text-center">
            
            <h1 class="mb-4">{{ $event->name }}</h1>

            @if ($recipientName)
                <p class="to-text">
                    Kepada Yth: <br>
                    <span class="d-block mt-2">{{ $recipientName }}</span>
                </p>
                <hr>
            @endif

            <p class="mt-4">Dengan segala kerendahan hati, kami mengundang Anda untuk hadir dalam acara kami:</p>
            
            <div class="mt-5">
                <h3>Kapan</h3>
                <p class="lead">
                    **{{ \Carbon\Carbon::parse($event->date)->format('l, d F Y') }}**
                    <br>
                    Pukul {{ \Carbon\Carbon::parse($event->time)->format('H:i') }} WIB
                </p>
            </div>

            <div class="mt-5">
                <h3>Dimana</h3>
                <p class="lead">
                    **{{ $event->location }}**
                    <br>
                </p>
            </div>
            
            <div class="mt-5">
                <h3>Pesan Khusus</h3>
                <p class="text-muted">{{ nl2br($event->description) }}</p>
            </div>

            <p class="mt-5">Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Anda berkenan hadir.</p>

            <div class="mt-5 p-4 border rounded text-start">
                <h3>Konfirmasi Kehadiran (RSVP)</h3>
                
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($recipient->rsvpResponse)
                    @php
                        $currentStatus = $recipient->rsvpResponse->status;
                        $currentPax = $recipient->rsvpResponse->pax;
                    @endphp
                    <div class="alert alert-info small">
                        Status Anda saat ini: 
                        @if ($currentStatus == 'hadir')
                            **Hadir** ({{ $currentPax }} Orang)
                        @elseif ($currentStatus == 'tidak_hadir')
                            **Tidak Hadir**
                        @else
                            **Belum Pasti**
                        @endif
                    </div>
                @endif

                <form action="{{ route('einvite.rsvp', $recipient->token) }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Status:</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="statusHadir" value="hadir" 
                                       required {{ old('status', $recipient->rsvpResponse->status ?? '') == 'hadir' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusHadir">Hadir</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="statusTidakHadir" value="tidak_hadir" 
                                       required {{ old('status', $recipient->rsvpResponse->status ?? '') == 'tidak_hadir' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusTidakHadir">Tidak Hadir</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="statusBelumPasti" value="belum_pasti" 
                                       required {{ old('status', $recipient->rsvpResponse->status ?? '') == 'belum_pasti' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusBelumPasti">Belum Pasti</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pax" class="form-label">Jumlah Kehadiran (Pax)</label>
                        <input type="number" name="pax" id="pax" class="form-control" min="1" 
                               value="{{ old('pax', $recipient->rsvpResponse->pax ?? 1) }}" placeholder="Jumlah orang yang akan hadir">
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Catatan/Pesan Tambahan (Opsional)</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3">{{ old('notes', $recipient->rsvpResponse->notes ?? '') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Kirim Konfirmasi RSVP</button>
                </form>
            </div>

            <footer class="mt-5 border-top pt-3">
                <p class="text-secondary">&copy; {{ date('Y') }} E-vite by {{ config('app.name') }}</p>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
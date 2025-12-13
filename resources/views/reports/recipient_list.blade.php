<!DOCTYPE html>
<html>
<head>
    <title>Laporan Tamu Event {{ $event->name }}</title>
    <style>
        body { font-family: sans-serif; font-size: 10pt; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { font-size: 18pt; }
    </style>
</head>
<body>
    <h1>Laporan Daftar Tamu</h1>
    <h2>Event: {{ $event->name }}</h2>
    <p>Lokasi: {{ $event->location }} | Waktu: {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }} {{ \Carbon\Carbon::parse($event->time)->format('H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Tamu</th>
                <th>Email / Kontak</th>
                <th>Status RSVP</th>
                <th>Check-in</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recipients as $index => $recipient)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $recipient->name }}</td>
                <td>{{ $recipient->email ?? '-' }}</td>
                <td>{{ $recipient->rsvpResponse->status ?? 'Belum Respon' }} ({{ $recipient->rsvpResponse->pax ?? 0 }} Pax)</td>
                <td>{{ $recipient->checked_in ? 'Sudah (' . \Carbon\Carbon::parse($recipient->checked_in_at)->format('H:i') . ')' : 'Belum' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
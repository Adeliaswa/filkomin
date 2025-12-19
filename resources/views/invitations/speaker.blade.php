<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Speaker Invitation - {{ $event->title }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
</head>

<body style="
    margin:0;
    padding:0;
    font-family:'Inter', sans-serif;
    background:#eef2ff;
">

<div style="
    max-width:640px;
    margin:70px auto;
    background:#ffffff;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 18px 35px rgba(0,0,0,0.12);
    position:relative;
">

    <!-- Decorative Shapes -->
    <div style="
        position:absolute;
        width:160px;
        height:160px;
        background:#c7d2fe;
        border-radius:50%;
        top:-60px;
        left:-60px;
        opacity:0.5;
    "></div>

    <div style="
        position:absolute;
        width:120px;
        height:120px;
        background:#e9d5ff;
        border-radius:50%;
        top:40px;
        right:-50px;
        opacity:0.45;
    "></div>

    <!-- Header -->
    <div style="
        padding:46px 36px 34px;
        text-align:center;
        position:relative;
    ">
        <h2 style="
            margin:0;
            font-family:'Playfair Display', serif;
            font-size:28px;
            font-weight:600;
            color:#4338ca;
        ">
            🎤 Speaker Invitation
        </h2>

        <p style="
            margin-top:10px;
            font-size:14px;
            color:#6366f1;
        ">
            {{ $event->title }}
        </p>
    </div>

    <!-- Content -->
    <div style="padding:38px 48px; color:#374151;">

        <p style="font-size:15px;">
            Hello <strong>{{ $guest->name }}</strong> 👋
        </p>

        <p style="font-size:15px; line-height:1.8;">
            We’re excited to invite you to join our upcoming event as a
            <strong>speaker</strong>.
            Your knowledge and experience would be an amazing addition to this event.
        </p>

        <!-- Event Card -->
        <div style="
            background:#f5f7ff;
            padding:26px 30px;
            margin:30px 0;
            border-radius:16px;
            font-size:14.5px;
            position:relative;
        ">
            <div style="
                position:absolute;
                width:70px;
                height:70px;
                background:#ddd6fe;
                border-radius:20px;
                top:-20px;
                right:-20px;
                opacity:0.5;
            "></div>

            <p style="margin:0 0 10px;">
                💡 <strong>Event:</strong> {{ $event->title }}
            </p>

            <p style="margin:0 0 10px;">
                🗓 <strong>Date:</strong>
                {{ \Carbon\Carbon::parse($event->date)->translatedFormat('l, d F Y') }}
            </p>

            <p style="margin:0 0 10px;">
                ⏰ <strong>Time:</strong>
                {{ $event->start_time }}
                @if($event->end_time)
                    – {{ $event->end_time }}
                @endif
            </p>

            <p style="margin:0;">
                📍 <strong>Location:</strong>
                @if($event->location_type === 'online')
                    Online ({{ $event->meeting_link }})
                @elseif($event->location_type === 'hybrid')
                    {{ $event->location }} / Online
                @else
                    {{ $event->location }}
                @endif
            </p>
        </div>

        <p style="font-size:15px; line-height:1.8;">
            We believe your session will inspire participants,
            spark ideas, and bring fresh perspectives 🚀
        </p>

        <p style="font-size:15px; line-height:1.8;">
            Further session details and technical arrangements
            will be shared after your confirmation.
        </p>

        <!-- Signature -->
        <div style="margin-top:42px;">
            <p style="margin-bottom:6px;">Best regards,</p>
            <p style="
                margin:0;
                font-weight:600;
                color:#4f46e5;
                font-size:15px;
            ">
                {{ $event->organizer_name }}<br>
                <small>{{ $event->organizer_unit }}</small>
            </p>
        </div>

        {{-- QR CODE --}}
        <div style="margin-top:50px; text-align:center;">
            <p><strong>Attendance QR Code</strong></p>
            <img
                src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ url('checkin/'.$guest->attendance_token) }}"
                alt="QR Code"
                style="width:180px;height:180px;"
            >
            <p style="font-size:12px;color:#666;">
                Please present this QR Code upon arrival.
            </p>
        </div>

        {{-- RSVP --}}
        <div style="margin-top:45px;">
            <form method="POST" action="{{ route('einvite.rsvp', $guest->invitation_token) }}">
                @csrf

                <p><strong>RSVP Confirmation</strong></p>

                <select name="status" required>
                    <option value="">Please select</option>
                    <option value="Hadir">Will Attend</option>
                    <option value="Tidak Hadir">Unable to Attend</option>
                    <option value="Belum Pasti">Tentative</option>
                </select>

                <br><br>

                <label>Notes (optional)</label><br>
                <textarea name="notes" rows="3" style="width:100%;"></textarea>

                <br><br>

                <label>Number of Attendees</label><br>
                <input type="number" name="pax" min="1" value="1">

                <br><br>

                <button type="submit">
                    Submit RSVP
                </button>
            </form>
        </div>

    </div>

    <!-- Footer -->
    <div style="
        text-align:center;
        font-size:12px;
        color:#9ca3af;
        padding:18px 0 22px;
        background:#fafaff;
    ">
        Crafted with 💻 & ☕ by <strong>Filkomin</strong>
    </div>

</div>

</body>
</html>

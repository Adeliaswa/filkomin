<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $event->title }}</title>

    <style>
        body {
            font-family: "Georgia", serif;
            background: #ffffff;
            margin: 0;
            padding: 0;
        }

        .page {
            width: 820px;
            margin: 60px auto;
            padding: 55px 65px;
            border: 1px solid #e3e3e3;
        }

        .header {
            text-align: center;
            margin-bottom: 50px;
        }

        .header h1 {
            font-size: 28px;
            letter-spacing: 2px;
            margin: 0;
            font-weight: normal;
        }

        .header span {
            display: block;
            font-size: 13px;
            letter-spacing: 1px;
            margin-top: 8px;
            color: #666;
        }

        .content {
            font-size: 15px;
            line-height: 1.9;
        }

        .content p {
            margin: 20px 0;
        }

        .event-info {
            margin: 40px 0;
        }

        .event-info table {
            width: 100%;
            border-collapse: collapse;
        }

        .event-info td {
            padding: 6px 0;
            vertical-align: top;
        }

        .label {
            width: 160px;
            font-size: 13px;
            font-weight: bold;
            color: #444;
        }

        .colon {
            width: 12px;
        }

        .footer {
            margin-top: 70px;
        }

        .signature {
            margin-top: 45px;
            font-size: 15px;
            font-weight: bold;
        }

        .qr {
            margin-top: 50px;
            text-align: center;
        }

        .qr img {
            width: 170px;
            height: 170px;
        }

        .crafted {
            margin-top: 80px;
            text-align: center;
            font-size: 11px;
            color: #999;
        }

        @media print {
            .page {
                margin: 0;
                border: none;
                padding: 55px;
            }
        }
    </style>
</head>

<body>

<div class="page">
    <div class="header">
        <h1>Invitation</h1>
        <span>You Are Cordially Invited</span>
    </div>

    <div class="content">

        <p>
            Dear <strong>{{ $guest->name }}</strong>,
        </p>

        <p>
            We are delighted to invite you to attend the following event.
            Your presence would mean a great deal to us.
        </p>

        <div class="event-info">
            <table>
                <tr>
                    <td class="label">Event</td>
                    <td class="colon">:</td>
                    <td>{{ $event->title }}</td>
                </tr>

                <tr>
                    <td class="label">Date</td>
                    <td class="colon">:</td>
                    <td>{{ \Carbon\Carbon::parse($event->date)->translatedFormat('l, d F Y') }}</td>
                </tr>

                <tr>
                    <td class="label">Time</td>
                    <td class="colon">:</td>
                    <td>
                        {{ $event->start_time }}
                        @if($event->end_time)
                            – {{ $event->end_time }}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class="label">Location</td>
                    <td class="colon">:</td>
                    <td>
                        @if($event->location_type === 'online')
                            Online ({{ $event->meeting_link }})
                        @elseif($event->location_type === 'hybrid')
                            {{ $event->location }} / Online
                        @else
                            {{ $event->location }}
                        @endif
                    </td>
                </tr>

                @if($event->dress_code)
                <tr>
                    <td class="label">Dress Code</td>
                    <td class="colon">:</td>
                    <td>{{ $event->dress_code }}</td>
                </tr>
                @endif
            </table>
        </div>

        <p>
            We look forward to welcoming you and hope you can join us on this occasion.
        </p>

        <div class="footer">
            <p>Warm regards,</p>

            <div class="signature">
                {{ $event->organizer_name }}<br>
                <small>{{ $event->organizer_unit }}</small>
            </div>
        </div>

        {{-- QR CODE --}}
        <div class="qr">
            <p><strong>Attendance QR Code</strong></p>
            <img
                src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ url('checkin/'.$guest->attendance_token) }}"
                alt="QR Code"
            >
            <p style="font-size:12px;color:#666;">
                Please show this QR Code upon arrival.
            </p>
        </div>

        {{-- RSVP --}}
        <div style="margin-top:45px;">
            <form method="POST" action="{{ route('einvite.rsvp', $guest->invitation_token) }}">
                @csrf

                <p><strong>RSVP</strong></p>

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

        <div class="crafted">
            Crafted with care by <strong>Filkomin</strong>
        </div>

    </div>
</div>

</body>
</html>

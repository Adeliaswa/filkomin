<!DOCTYPE html>
<html>
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
            margin: 80px auto;
            padding: 60px 70px;
            border: 1px solid #ddd;
        }

        .header {
            text-align: center;
            margin-bottom: 60px;
        }

        .header h1 {
            font-size: 30px;
            letter-spacing: 4px;
            margin: 0;
            font-weight: normal;
        }

        .header span {
            display: block;
            font-size: 12px;
            letter-spacing: 2px;
            margin-top: 10px;
            color: #555;
        }

        .content {
            font-size: 15px;
            line-height: 2;
        }

        .content p {
            margin: 22px 0;
            text-align: justify;
        }

        .event-info {
            margin: 45px 0;
        }

        .event-info table {
            width: 100%;
            border-collapse: collapse;
        }

        .event-info td {
            padding: 8px 0;
            vertical-align: top;
        }

        .label {
            width: 180px;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 1px;
            color: #444;
        }

        .colon {
            width: 15px;
        }

        .footer {
            margin-top: 80px;
        }

        .signature {
            margin-top: 60px;
            font-size: 16px;
            font-weight: bold;
        }

        .crafted {
            margin-top: 90px;
            text-align: center;
            font-size: 11px;
            letter-spacing: 1px;
            color: #999;
        }

        @media print {
            .page {
                margin: 0;
                border: none;
                padding: 60px;
            }

            .crafted {
                margin-top: 120px;
            }
        }
    </style>
</head>

<body>

    <div class="page">
        <div class="header">
            <h1>OFFICIAL INVITATION</h1>
            <span>FORMAL EVENT NOTICE</span>
        </div>

        <div class="content">
            <p>To whom it may concern,</p>

            <p>
                With great respect, we are pleased to invite you to attend the following event:
            </p>

            <div class="event-info">
                <table>
                    <tr>
                        <td class="label">Event</td>
                        <td class="colon">:</td>
                        <td>{{ $event->title }}</td>
                    </tr>
                    <tr>
                        <td class="label">Date & Time</td>
                        <td class="colon">:</td>
                        <td>{{ $event->event_time }}</td>
                    </tr>
                    <tr>
                        <td class="label">Location</td>
                        <td class="colon">:</td>
                        <td>{{ $event->location }}</td>
                    </tr>
                    <tr>
                        <td class="label">Dress Code</td>
                        <td class="colon">:</td>
                        <td>{{ $event->dresscode }}</td>
                    </tr>
                </table>
            </div>

            <p>
                We would be honored by your presence at this event. Your attendance will be highly appreciated.
            </p>

            <div class="footer">
                <p>Sincerely,</p>

                <div class="signature">
                    {{ $event->organizer }}
                </div>
            </div>

            <!-- Crafted Credit -->
            <div class="crafted">
                Crafted with care by <strong>Filkomin</strong>
            </div>
        </div>
    </div>

</body>
</html>

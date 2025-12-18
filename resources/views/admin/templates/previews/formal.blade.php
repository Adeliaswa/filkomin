<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $event->title }}</title>

    <style>
        body {
            font-family: "Times New Roman", serif;
            line-height: 1.8;
            margin: 60px;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h2 {
            margin: 0;
            font-size: 22px;
            letter-spacing: 1px;
        }

        .content {
            font-size: 14px;
        }

        .event-info {
            margin: 25px 0;
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
            width: 150px;
            font-weight: bold;
        }

        .footer {
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>OFFICIAL INVITATION</h2>
    </div>

    <div class="content">
        <p>To whom it may concern,</p>

        <p>
            We respectfully invite you to attend the following event:
        </p>

        <div class="event-info">
            <table>
                <tr>
                    <td class="label">Event</td>
                    <td>: {{ $event->title }}</td>
                </tr>
                <tr>
                    <td class="label">Date & Time</td>
                    <td>: {{ $event->event_time }}</td>
                </tr>
                <tr>
                    <td class="label">Location</td>
                    <td>: {{ $event->location }}</td>
                </tr>
                <tr>
                    <td class="label">Dress Code</td>
                    <td>: {{ $event->dresscode }}</td>
                </tr>
            </table>
        </div>

        <p>
            Your presence will be highly appreciated.
        </p>

        <div class="footer">
            <p>Best regards,</p>
            <p><strong>{{ $event->organizer }}</strong></p>
        </div>
    </div>

</body>
</html>

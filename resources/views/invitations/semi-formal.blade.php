<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $event->title }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
</head>

<body style="
    margin:0;
    padding:0;
    font-family: 'Inter', sans-serif;
    background: radial-gradient(circle at top, #1a1f2b, #0f1218);
    color: #e5e7eb;
">

    <div style="
        max-width: 720px;
        margin: 70px auto;
        background: #0f1624;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 30px 60px rgba(0,0,0,0.6);
        border: 1px solid #1f2937;
    ">

        <!-- Header -->
        <div style="
            padding: 34px 36px;
            background: linear-gradient(135deg, #111827, #1f2937);
            border-bottom: 1px solid #273244;
        ">
            <p style="
                margin: 0 0 6px;
                font-family: 'JetBrains Mono', monospace;
                font-size: 12px;
                color: #38bdf8;
                letter-spacing: 1.5px;
                text-transform: uppercase;
            ">
                // Invitation Preview
            </p>

            <h2 style="
                margin: 0;
                font-size: 28px;
                font-weight: 600;
                color: #f9fafb;
            ">
                {{ $event->title }}
            </h2>
        </div>

        <!-- Content -->
        <div style="padding: 40px 46px;">

            <p style="font-size: 15.5px; color:#d1d5db;">
                Hello,
            </p>

            <p style="font-size: 15.5px; line-height: 1.9; color:#cbd5f5;">
                We invite you to be part of an event where ideas are shared,
                discussions evolve, and progress is made — step by step.
            </p>

            <!-- Event Info (Iterative Card) -->
            <div style="
                margin: 36px 0;
                padding: 28px 32px;
                background: linear-gradient(135deg, #0b1220, #111827);
                border-radius: 12px;
                border: 1px solid #1e293b;
            ">
                <table style="width:100%; font-size:15px;">
                    <tr>
                        <td style="padding: 8px 0; font-family:'JetBrains Mono'; color:#22d3ee;">
                            step_1: datetime
                        </td>
                        <td style="padding: 8px 0; color:#e5e7eb;">
                            {{ $event->event_time }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-family:'JetBrains Mono'; color:#22d3ee;">
                            step_2: location
                        </td>
                        <td style="padding: 8px 0; color:#e5e7eb;">
                            {{ $event->location }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-family:'JetBrains Mono'; color:#22d3ee;">
                            step_3: dress_code
                        </td>
                        <td style="padding: 8px 0; color:#e5e7eb;">
                            {{ $event->dresscode }}
                        </td>
                    </tr>
                </table>
            </div>

            <p style="font-size: 15.5px; line-height: 1.9; color:#d1d5db;">
                {{ $event->description }}
            </p>

            <p style="font-size: 15.5px; margin-top: 34px; color:#cbd5f5;">
                Let’s iterate, collaborate, and move forward together.
            </p>

            <p style="
                margin-top: 42px;
                font-weight: 600;
                color: #38bdf8;
                font-size: 15.5px;
            ">
                — {{ $event->organizer }}
            </p>

        </div>

        <!-- Footer -->
        <div style="
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            padding: 18px 0 22px;
            background: #0b1220;
            border-top: 1px solid #1f2937;
            font-family: 'JetBrains Mono', monospace;
        ">
            crafted.iteratively.by <strong>Filkomin</strong>
        </div>

    </div>

</body>
</html>

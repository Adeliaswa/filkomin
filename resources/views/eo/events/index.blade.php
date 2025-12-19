@extends('layouts.eo')

@section('content')

{{-- =========================
   NOTIFIKASI EO
========================= --}}
@if(session('success'))
    <div style="
        background:#eef2ff;
        border:1px solid #c7d2fe;
        color:#3730a3;
        padding:14px 18px;
        border-radius:12px;
        margin-bottom:20px;
        font-weight:500;
    ">
        ✅ {{ session('success') }}
    </div>
@endif

<h1 style="font-size:24px;font-weight:700;margin-bottom:20px;">
    My Events
</h1>

<div style="
    background:#fff;
    border-radius:16px;
    padding:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.05);
">

    @if($events->count() === 0)
        <p style="color:#666;">
            Belum ada event yang dibuat.
        </p>
    @else
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="border-bottom:1px solid #eee;">
                    <th style="text-align:left;padding:10px;">Event</th>
                    <th style="text-align:left;padding:10px;">Category</th>
                    <th style="text-align:left;padding:10px;">Date</th>
                    <th style="text-align:left;padding:10px;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr style="border-bottom:1px solid #f1f1f1;">
                        <td style="padding:10px;">
                            <strong>{{ $event->title }}</strong>
                        </td>
                        <td style="padding:10px;">
                            {{ ucfirst($event->category) }}
                        </td>
                        <td style="padding:10px;">
                            {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                        </td>
                        <td style="padding:10px;">
                            @if($event->status === 'pending')
                                <span style="color:#d97706;font-weight:600;">
                                    Pending Review
                                </span>
                            @elseif($event->status === 'approved')
                                <span style="color:#059669;font-weight:600;">
                                    Approved
                                </span>
                            @elseif($event->status === 'rejected')
                                <span style="color:#dc2626;font-weight:600;">
                                    Rejected
                                </span>
                            @else
                                <span style="color:#6b7280;">
                                    {{ ucfirst($event->status) }}
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>

@endsection

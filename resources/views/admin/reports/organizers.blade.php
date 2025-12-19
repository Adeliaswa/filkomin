@extends('layouts.admin')

@section('content')
<h1>Reports - Event Organizers</h1>

<form method="GET" class="mb-3">
  <label>From</label>
  <input type="date" name="from" value="{{ \Carbon\Carbon::parse($from)->toDateString() }}">
  <label>To</label>
  <input type="date" name="to" value="{{ \Carbon\Carbon::parse($to)->toDateString() }}">
  <button type="submit">Filter</button>
</form>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>Organizer</th>
      <th>Email</th>
      <th>Events</th>
      <th>Invitations</th>
      <th>Going</th>
      <th>Not Going</th>
    </tr>
  </thead>
  <tbody>
    @foreach($rows as $r)
      <tr>
        <td>{{ $r->name }}</td>
        <td>{{ $r->email }}</td>
        <td>{{ $r->events_total }}</td>
        <td>{{ $r->invitations_total }}</td>
        <td>{{ $r->rsvp_going }}</td>
        <td>{{ $r->rsvp_not_going }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

<div style="margin-top:12px;">
  {{ $rows->links() }}
</div>
@endsection

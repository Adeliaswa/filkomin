@extends('layouts.eo')

@section('content')

<aside class="sidebar">
  <div class="title">EO Navigation</div>

  <a href="#" class="nav-link active" data-page="event-list-content" onclick="showPage('event-list-content', this)">
    <span class="icon"><i class="fas fa-calendar-alt"></i></span> Event List
  </a>
  <a href="#" class="nav-link" data-page="create-event-content" onclick="showPage('create-event-content', this)">
    <span class="icon"><i class="fas fa-plus-circle"></i></span> Create Event
  </a>

  <div id="extra-menu" style="display:none; border-top: 1px solid var(--soft); margin-top: 10px; padding-top: 10px;">
    <div style="padding-left: 20px; font-size: 10px; color: var(--muted); margin-bottom: 5px;">EVENT TOOLS</div>
    <a href="#" class="nav-link" data-page="guest-management-content" onclick="showPage('guest-management-content', this)">
      <span class="icon"><i class="fas fa-users"></i></span> Manage Guests
    </a>
    <a href="#" class="nav-link" data-page="send-invitations-content" onclick="showPage('send-invitations-content', this)">
      <span class="icon"><i class="fas fa-paper-plane"></i></span> Send Invitations
    </a>
    <a href="#" class="nav-link" data-page="rsvp-monitoring-content" onclick="showPage('rsvp-monitoring-content', this)">
      <span class="icon"><i class="fas fa-chart-pie"></i></span> RSVP Monitoring
    </a>
  </div>

  <div style="margin-top: auto; padding-top: 20px;">
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="nav-link text-danger">
        <span class="icon"><i class="fas fa-sign-out-alt"></i></span> Logout
      </a>
    </form>
  </div>
</aside>

<section class="dashboard-content">
  <h1 id="dashboard-title">TEST</h1>

  <div id="event-list-content" class="page-content active">
    <div class="event-list-controls">
      <div class="left">
        <input type="text" placeholder="Search event..." id="event-search" onkeyup="filterEvents()">
      </div>
      <div class="right">
        <button class="btn btn-primary" onclick="showPage('create-event-content', document.querySelector('[onclick*=\'create-event-content\']'))">
          <i class="fas fa-plus"></i> Create New Event
        </button>
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th>Event Title</th>
          <th>Date</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($events as $event)
        <tr>
          <td><strong>{{ $event->title ?? $event->name }}</strong></td>
          <td>{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</td>
          <td>
            <span class="badge {{ ($event->status ?? 'Active') == 'Approved' ? 'badge-approved' : 'badge-pending' }}">
              {{ $event->status ?? 'Active' }}
            </span>
          </td>
          <td>
            <button class="btn btn-secondary" onclick="manageEvent('{{ $event->id }}', '{{ $event->title ?? $event->name }}')">
              <i class="fas fa-cog"></i> Manage
            </button>
            <a href="{{ route('events.show', $event->id) }}" class="btn btn-ghost">
              <i class="fas fa-eye"></i> View
            </a>
            <a href="{{ route('events.export.pdf', $event->id) }}" class="btn btn-ghost text-danger">
              <i class="fas fa-file-pdf"></i> PDF
            </a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" style="text-align:center; padding:40px;">No events found. Start by creating one!</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Additional Pages (Create Event, Guest Management, RSVP Monitoring) -->

</section>

<script>
  let currentEventId = null;

  // Function to switch between pages
  function showPage(pageId, element) {
    document.querySelectorAll('.page-content').forEach(p => p.style.display = 'none');
    document.getElementById(pageId).style.display = 'block';

    if (element) {
      document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
      element.classList.add('active');
    }
  }

  // Function to manage event
  function manageEvent(id, title) {
    currentEventId = id;
    document.getElementById('extra-menu').style.display = 'block';
    alert('Event "' + title + '" selected. Event Tools are now active in the sidebar.');
  }

  // Function to filter events
  function filterEvents() {
    let input = document.getElementById('event-search').value.toLowerCase();
    let rows = document.querySelectorAll('tbody tr');
    rows.forEach(row => {
      let text = row.innerText.toLowerCase();
      row.style.display = text.includes(input) ? '' : 'none';
    });
  }

  // Event listener for page load
  window.onload = function() {
    showPage('event-list-content');
  };
</script>

@endsection

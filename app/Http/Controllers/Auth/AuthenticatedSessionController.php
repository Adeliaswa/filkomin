@extends('layouts.eo')

@section('content')

<style>
  .eo-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }

  .eo-header h1 {
    font-size: 26px;
    font-weight: 700;
  }

  .eo-actions {
    display: flex;
    gap: 12px;
  }

  .eo-card {
    background: #fff;
    border-radius: 18px;
    padding: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,.05);
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
  }

  thead {
    background: #f1ede4;
  }

  th, td {
    padding: 14px;
    text-align: left;
    font-size: 14px;
  }

  th {
    font-size: 12px;
    font-weight: 600;
    color: #555;
  }

  tbody tr {
    border-bottom: 1px solid #eee;
  }

  tbody tr:last-child {
    border-bottom: none;
  }

  .badge {
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
  }

  .badge-approved { background: #4caf50; color: #fff; }
  .badge-pending { background: #ffcc66; color: #333; }
  .badge-rejected { background: #f44336; color: #fff; }
  .badge-draft { background: #9e9e9e; color: #fff; }

  .action-link {
    color: #4f79ff;
    font-weight: 600;
    text-decoration: none;
    margin-right: 10px;
  }

  .action-link:hover {
    text-decoration: underline;
  }
</style>

{{-- HEADER --}}
<div class="eo-header">
  <h1>Event Organizer Dashboard</h1>

  <div class="eo-actions">
    <a href="{{ route('events.create') }}" class="btn btn-primary">
      <i class="fas fa-plus"></i> Create New Event
    </a>
  </div>
</div>

{{-- TABLE CARD --}}
<div class="eo-card">
  <table>
    <thead>
      <tr>
        <th>EVENT TITLE</th>
        <th>DATE</th>
        <th>TEMPLATE</th>
        <th>STATUS</th>
        <th>LAST UPDATED</th>
        <th>ACTIONS</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($events as $event)
        <tr>
          <td><strong>{{ $event->title }}</strong></td>
          <td>{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}</td>
          <td>{{ $event->template ?? 'Formal' }}</td>
          <td>
            @if ($event->status === 'approved')
              <span class="badge badge-approved">Approved</span>
            @elseif ($event->status === 'pending')
              <span class="badge badge-pending">Pending</span>
            @elseif ($event->status === 'rejected')
              <span class="badge badge-rejected">Rejected</span>
            @else
              <span class="badge badge-draft">Draft</span>
            @endif
          </td>
          <td>{{ $event->updated_at->format('Y-m-d H:i') }}</td>
          <td>
            <a href="{{ route('events.show', $event->id) }}" class="action-link">
              <i class="fas fa-eye"></i> View
            </a>

            @if (in_array($event->status, ['pending', 'draft']))
              <a href="{{ route('events.edit', $event->id) }}" class="action-link">
                <i class="fas fa-pen"></i> Edit
              </a>
            @endif

            @if ($event->status === 'rejected')
              <a href="{{ route('events.edit', $event->id) }}" class="action-link">
                <i class="fas fa-rotate-right"></i> Resubmit
              </a>
            @endif
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" style="text-align:center; padding:40px;">
            Belum ada event.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

@endsection

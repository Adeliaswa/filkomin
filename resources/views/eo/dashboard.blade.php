@extends('layouts.eo')

@section('content')

<style>
  /* HEADER */
  .eo-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
  }

  .eo-header h1 {
    font-size: 26px;
    font-weight: 700;
    margin: 0;
  }

  /* FILTER BAR */
  .eo-filters {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 14px;
  }

  .eo-filters select,
  .eo-filters input {
    padding: 8px 12px;
    border-radius: 10px;
    border: 1px solid #ddd;
    font-size: 13px;
    background: #fff;
  }

  /* CARD */
  .eo-card {
    background: #fff;
    border-radius: 18px;
    padding: 18px;
    box-shadow: 0 10px 30px rgba(0,0,0,.05);
  }

  /* TABLE */
  table {
    width: 100%;
    border-collapse: collapse;
  }

  thead {
    background: #f1ede4;
  }

  th {
    font-size: 12px;
    font-weight: 600;
    color: #555;
    padding: 12px;
    text-align: left;
  }

  td {
    padding: 14px 12px;
    font-size: 14px;
    border-bottom: 1px solid #eee;
    vertical-align: middle;
  }

  tbody tr:last-child td {
    border-bottom: none;
  }

  /* BADGE */
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

  /* ACTIONS */
  .action-link {
    color: #4f79ff;
    font-weight: 600;
    text-decoration: none;
    margin-right: 12px;
    font-size: 13px;
    white-space: nowrap;
  }

  .action-link:hover {
    text-decoration: underline;
  }

  .action-link i {
    margin-right: 4px;
  }
</style>

{{-- HEADER --}}
<div class="eo-header">
  <h1>Event Organizer Dashboard</h1>

  <a href="{{ route('eo.events.create') }}" class="btn btn-primary">
    <i class="fas fa-plus"></i> Create New Event
  </a>
</div>

{{-- FILTER (UI ONLY, BACKEND BISA NYUSUL) --}}
<div class="eo-filters">
  <select>
    <option value="">All Status</option>
    <option value="approved">Approved</option>
    <option value="pending">Pending</option>
    <option value="rejected">Rejected</option>
    <option value="draft">Draft</option>
  </select>

  <input type="text" placeholder="Search event title..." />
</div>

{{-- TABLE --}}
<div class="eo-card">
  <table>
    <thead>
      <tr>
        <th>EVENT TITLE</th>
        <th>DATE</th>
        <th>CATEGORY</th>
        <th>STATUS</th>
        <th>LAST UPDATED</th>
        <th>ACTIONS</th>
      </tr>
    </thead>

    <tbody>
      @forelse ($events as $event)
        <tr>
          <td><strong>{{ $event->title }}</strong></td>

          <td>
            {{ $event->date
                ? \Carbon\Carbon::parse($event->date)->format('d M Y')
                : '-' }}
          </td>

          {{-- TEMPLATE = DARI CATEGORY --}}
          <td>
            {{ ucfirst(str_replace('-', ' ', $event->category ?? 'formal')) }}
          </td>

          <td>
            @switch($event->status)
              @case('approved')
                <span class="badge badge-approved">Approved</span>
                @break
              @case('pending')
                <span class="badge badge-pending">Pending</span>
                @break
              @case('rejected')
                <span class="badge badge-rejected">Rejected</span>
                @break
              @default
                <span class="badge badge-draft">Draft</span>
            @endswitch
          </td>

          <td>
            {{ $event->updated_at
                ? $event->updated_at->format('d M Y H:i')
                : '-' }}
          </td>

          <td>
            {{-- VIEW --}}
            <a href="{{ route('events.show', $event->id) }}" class="action-link">
              <i class="fas fa-eye"></i> View
            </a>

            {{-- EDIT / RESUBMIT --}}
            @if (in_array($event->status, ['draft', 'pending', 'rejected']))
              <a href="{{ route('events.edit', $event->id) }}" class="action-link">
                <i class="fas fa-pen"></i>
                {{ $event->status === 'rejected' ? 'Resubmit' : 'Edit' }}
              </a>
            @endif

            {{-- PREVIEW (SETELAH APPROVED) --}}
            @if ($event->status === 'approved')
              <a href="{{ route('eo.events.preview', $event->id) }}"
                 target="_blank"
                 class="action-link">
                <i class="fas fa-envelope-open-text"></i> Preview
              </a>
            @endif
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" style="text-align:center;padding:40px;">
            Belum ada event.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

@endsection
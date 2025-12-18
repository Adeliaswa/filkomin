@extends('layouts.eo')

@section('content')

<section class="dashboard-content">

  <h1>Buat Event Baru</h1>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('events.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label>Nama Event</label>
      <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Tanggal & Waktu</label>
      <input type="datetime-local" name="event_time" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Lokasi</label>
      <input type="text" name="location" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Dress Code</label>
      <input type="text" name="dresscode" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Organizer</label>
      <input type="text" name="organizer" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Template E-vite</label>
      <select name="template_id" class="form-control" required>
        <option value="">-- Pilih Template --</option>
        @foreach ($templates as $template)
          <option value="{{ $template->id }}">
            {{ $template->name }}
          </option>
        @endforeach
      </select>
    </div>

    <button type="submit" class="btn btn-primary">
      Simpan Event
    </button>

  </form>

</section>

@endsection

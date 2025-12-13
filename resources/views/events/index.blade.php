
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Event Dashboard</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="d-flex justify-content-between mb-3">
        <h4>Daftar Event Anda</h4>
        <a href="{{ route('events.create') }}" class="btn btn-primary">Buat Event Baru</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Event</th>
                <th>Tanggal & Waktu</th>
                <th>Lokasi</th>
                <th>Jumlah Tamu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($events as $event)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $event->name }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }} <br>
                    ({{ \Carbon\Carbon::parse($event->time)->format('H:i') }} WIB)
                </td>
                <td>{{ $event->location }}</td>
                <td>{{ $event->recipients->count() }} Tamu</td>
                <td>
                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-info btn-sm">Lihat Detail</a>
                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus event?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Anda belum memiliki Event. Silakan buat yang pertama!</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
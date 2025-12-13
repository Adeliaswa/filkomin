
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Event: {{ $event->name }}</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT') 
        
        <div class="card p-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nama Event</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $event->name) }}" required>
                </div>
                
                <div class="col-md-3 mb-3">
                    <label for="date" class="form-label">Tanggal Acara</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $event->date) }}" required>
                </div>
                
                <div class="col-md-3 mb-3">
                    <label for="time" class="form-label">Waktu Acara</label>
                    <input type="time" name="time" id="time" class="form-control" value="{{ old('time', $event->time) }}" required>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label for="location" class="form-label">Lokasi</label>
                    <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $event->location) }}" required>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label for="description" class="form-label">Deskripsi/Pesan Tambahan</label>
                    <textarea name="description" id="description" class="form-control">{{ old('description', $event->description) }}</textarea>
                </div>

                <div class="col-md-12 mb-4">
                    <label for="template_id" class="form-label">Pilih Template E-vite</label>
                    <select name="template_id" id="template_id" class="form-control" required>
                        <option value="">-- Pilih Template --</option>
                        @foreach ($templates as $template)
                            <option value="{{ $template->id }}" {{ old('template_id', $event->template_id) == $template->id ? 'selected' : '' }}>
                                {{ $template->name }} ({{ $template->description }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success">Perbarui Event</button>
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
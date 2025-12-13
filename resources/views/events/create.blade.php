<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Event Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h2>Formulir Pembuatan Event</h2>
                
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
                    <div class="card p-4">
                        <div class="row">
                        
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Nama Event (Title)</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="event_time" class="form-label">Tanggal & Waktu Acara</label>
                                <input type="datetime-local" name="event_time" id="event_time" class="form-control" value="{{ old('event_time') }}" required>
                            </div>
                            
                            <div class="col-md-12 mb-3">
                                <label for="location" class="form-label">Lokasi</label>
                                <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="dresscode" class="form-label">Dress Code</label>
                                <input type="text" name="dresscode" id="dresscode" class="form-control" value="{{ old('dresscode') }}" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="organizer" class="form-label">Nama Organizer</label>
                                <input type="text" name="organizer" id="organizer" class="form-control" value="{{ old('organizer') }}" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">Deskripsi/Pesan Tambahan</label>
                                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label for="template_id" class="form-label">Pilih Template E-vite</label>
                                <select name="template_id" id="template_id" class="form-control" required>
                                    <option value="">-- Pilih Template --</option>
                                    @foreach ($templates as $template)
                                        <option value="{{ $template->id }}" {{ old('template_id') == $template->id ? 'selected' : '' }}>
                                            {{ $template->name }} ({{ $template->description }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan Event</button>
                                <a href="{{ route('events.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
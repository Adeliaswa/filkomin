<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Event: ') . $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="container">
                
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card p-4 shadow-sm">
                            <h4>Informasi Acara</h4>

                            <p><strong>Tanggal & Waktu:</strong> 
                                {{ \Carbon\Carbon::parse($event->event_time)->format('d F Y') }} pukul 
                                {{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }} WIB
                            </p>

                            <p><strong>Lokasi:</strong> {{ $event->location }}</p>
                            <p><strong>Dress Code:</strong> {{ $event->dresscode }}</p>
                            <p><strong>Organizer:</strong> {{ $event->organizer }}</p>
                            <p><strong>Template Digunakan:</strong> {{ $event->template->name }}</p>
                            <p><strong>Pesan Tambahan:</strong> <br>{{ $event->description }}</p>
                            
                            <hr>

                            <h5 class="mt-3">Link Utama E-vite Anda</h5>
                            <div class="input-group mb-3">
                                @php
                                    $baseUrl = route('einvite.show', $event->token);
                                @endphp
                                <input type="text" class="form-control" value="{{ $baseUrl }}" readonly>
                                <button class="btn btn-outline-secondary" type="button" onclick="navigator.clipboard.writeText('{{ $baseUrl }}'); alert('URL utama disalin!')">Copy URL</button>
                            </div>
                            <small class="text-muted">Gunakan link ini untuk tamu yang tidak terdaftar (tanpa nama spesifik).</small>
                            
                            <div class="mt-3">
                                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit Event</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card p-4 shadow-sm">
                            <h4>Tambahkan Tamu Baru</h4>
                            <form action="{{ route('recipients.store', $event->id) }}" method="POST" class="mb-4">
                                @csrf
                                
                                <input type="hidden" name="event_id" value="{{ $event->id }}">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Tamu</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Contoh: Budi & Keluarga" required>
                                </div>

                                <div class="mb-3">
                                    <label for="phone_wa" class="form-label">Nomor WA</label>
                                    <input type="text" name="phone_wa" id="phone_wa" class="form-control" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Tambahkan Tamu</button>
                            </form>

                            <hr>

                            <h4>Daftar Tamu ({{ $recipients->count() }} Orang)</h4> 
                            
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>RSVP</th>
                                            <th>Link Personal</th>
                                            <th>Token Check-in</th>
                                            <th width="1%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($recipients as $recipient)
                                        <tr>
                                            <td>{{ $recipient->name }}</td>
                                            <td>
                                                @if ($recipient->rsvpResponse) 
                                                    <span class="badge {{ $recipient->rsvpResponse->status == 'hadir' ? 'bg-success' : 'bg-danger' }}">
                                                        {{ ucfirst($recipient->rsvpResponse->status) }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">Belum RSVP</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $personalLink = route('einvite.show', $recipient->token);
                                                @endphp
                                                <button class="btn btn-outline-info btn-sm" onclick="navigator.clipboard.writeText('{{ $personalLink }}'); alert('Link tamu disalin!')">
                                                    Copy Link
                                                </button>
                                            </td>

                                            <td style="font-size: 0.7em;">
                                                {{ $recipient->token }}
                                            </td>

                                            <td>
                                                <form action="{{ route('recipients.destroy', ['event' => $event->id, 'recipient' => $recipient->id]) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus tamu {{ $recipient->name }}?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Belum ada tamu yang ditambahkan.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <a href="{{ route('events.export.pdf', $event->id) }}" class="btn btn-outline-secondary mt-3">Export Daftar Tamu (PDF)</a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
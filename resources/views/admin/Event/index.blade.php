<x-app-layout>
    <x-slot name="title">Manajemen Event</x-slot>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 py-4 gap-3">
        <h2 class="text-2xl font-merriweather font-semibold text-gray-800">Daftar Event</h2>

        <a href="{{ route('event.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
            <x-heroicon-o-plus class="w-5 h-5" />
            Tambah Event
        </a>
    </div>

    <x-message />

    @if ($event->count())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($event as $e)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition flex flex-col">

                    {{-- Gambar Event --}}
                    @if ($e->image)
                        <img src="{{ Storage::url($e->image) }}" alt="{{ $e->nama_event }}"
                            class="w-full h-40 object-cover rounded-t">
                    @else
                        <div class="w-full h-40 bg-gray-200 flex items-center justify-center rounded-t">
                            <span class="text-gray-500 text-sm">Tidak ada gambar</span>
                        </div>
                    @endif

                    <div class="p-5 flex flex-col justify-between flex-grow">
                        <div>
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $e->nama_event }}</h3>
                                <!-- Status Badge -->
                                @php
                                    $color = match ($e->status) {
                                        'Akan Datang' => 'bg-yellow-100 text-yellow-700',
                                        'Sedang Berlangsung' => 'bg-blue-100 text-blue-700',
                                        'Selesai' => 'bg-green-100 text-green-700',
                                        default => 'bg-gray-100 text-gray-700',
                                    };
                                @endphp
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $color }}">
                                    {{ $e->status }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 mb-1">Tema: {{ $e->tema ?? '-' }}</p>
                            <p class="text-sm text-gray-600 mb-1">Lokasi: {{ $e->lokasi ?? '-' }}</p>
                            <p class="text-sm text-gray-600 mb-1">
                                <x-heroicon-o-calendar class="w-4 h-4 inline mr-1 text-indigo-500" />
                                {{ $e->tanggal_mulai->format('d M Y H:i') }}
                                @if ($e->tanggal_selesai)
                                    - {{ $e->tanggal_selesai->format('H:i') }}
                                @endif
                            </p>
                            <p class="text-sm text-gray-600 mb-2">
                                Biaya:
                                @if ($e->biaya > 0)
                                    Rp{{ number_format($e->biaya, 0, ',', '.') }}
                                @else
                                    <span class="text-green-600 font-semibold">Gratis</span>
                                @endif
                            </p>
                        </div>

                        <div class="mt-4 flex justify-between items-center">
                            <!-- Actions -->
                            <div class="space-x-2 text-sm">
                                <a href="{{ route('event.peserta', $e->id) }}"
                                    class="inline-flex items-center gap-1 text-green-600 hover:text-green-900 font-medium">
                                    <x-heroicon-o-user-group class="w-4 h-4" />
                                    Peserta
                                </a>
                                <a href="{{ route('event.edit', $e->id) }}"
                                    class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-900 font-medium">
                                    <x-heroicon-o-pencil-square class="w-4 h-4" /> Edit
                                </a>
                                <form id="delete-form-{{ $e->id }}"
                                    action="{{ route('event.destroy', $e->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button"
                                    onclick="confirmDelete('{{ $e->id }}', 'Hapus {{ $e->nama_event }}?', 'Event akan dihapus permanen.')"
                                    class="inline-flex items-center gap-1 text-red-600 hover:text-red-900 font-medium">
                                    <x-heroicon-o-trash class="w-4 h-4" /> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $event->links() }}
        </div>
    @else
        <p class="text-center text-gray-500">Belum ada event.</p>
    @endif
</x-app-layout>

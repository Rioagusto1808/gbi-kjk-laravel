<x-app-layout>
    <x-slot name="title">Manajemen Berita</x-slot>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 py-4 gap-3">
        <h2 class="text-2xl font-merriweather font-semibold text-gray-800">Daftar Berita</h2>

        <a href="{{ route('berita.create') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
            <x-heroicon-o-plus class="w-5 h-5" />
            Tambah Berita
        </a>
    </div>

    <x-message />

    @if($berita->count())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($berita as $b)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-5 flex flex-col justify-between">
                    <div>
                        <!-- Foto utama -->
                        @if($b->files->count())
                            <img src="{{ asset('storage/'.$b->files->first()->path) }}"
                                 class="w-full h-40 object-cover rounded mb-3" alt="Foto Berita">
                        @endif

                        <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $b->judul }}</h3>
                        <p class="text-sm text-gray-600 line-clamp-3">{{ Str::limit(strip_tags($b->isi), 120) }}</p>
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-xs text-gray-500">
                            {{ $b->published_at ? 'Dipublish '.$b->published_at->format('d M Y H:i') : 'Draft' }}
                        </span>

                        <div class="space-x-2 text-sm">
                            <a href="{{ route('berita.edit', $b->id) }}"
                               class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-900 font-medium">
                                <x-heroicon-o-pencil-square class="w-4 h-4" /> Edit
                            </a>
                            <form id="delete-form-{{ $b->id }}" action="{{ route('berita.destroy', $b->id) }}" method="POST" class="inline-block hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button"
                                    onclick="confirmDelete('{{ $b->id }}', 'Hapus {{ $b->judul }}?', 'Data berita akan masuk kotak sampah.')"
                                    class="inline-flex items-center gap-1 text-red-600 hover:text-red-900 font-medium">
                                <x-heroicon-o-trash class="w-4 h-4" /> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $berita->links() }}
        </div>
    @else
        <p class="text-center text-gray-500">Belum ada berita.</p>
    @endif
</x-app-layout>

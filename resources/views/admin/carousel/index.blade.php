<x-app-layout>
    <x-slot name="title">Manajemen Carousel</x-slot>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 py-4 gap-3">
        <h2 class="text-2xl font-merriweather font-semibold text-gray-800">Daftar Carousel</h2>

        <a href="{{ route('carousel.create') }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
            <x-heroicon-o-plus class="w-5 h-5" />
            Tambah Carousel
        </a>
    </div>

    <x-message />

    @if ($carousels->count())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($carousels as $c)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-5 flex flex-col justify-between">
                    <div>
                        <!-- Foto carousel -->
                        @if ($c->image)
                            <img src="{{ Storage::url($c->image) }}" class="w-full h-40 object-cover rounded mb-3"
                                alt="{{ $c->judul }}">
                        @else
                            <div class="w-full h-40 bg-gray-200 flex items-center justify-center rounded mb-3">
                                <span class="text-gray-500 text-sm">Tidak ada gambar</span>
                            </div>
                        @endif

                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $c->judul ?? '-' }}</h3>
                            <!-- Badge urutan -->
                            <span class="text-xs font-medium px-2 py-1 bg-blue-100 text-blue-700 rounded-full">
                                Urutan: {{ $c->urutan }}
                            </span>
                        </div>

                        <p class="text-sm text-gray-600 line-clamp-3">
                            {{ Str::limit(strip_tags($c->deskripsi ?? ''), 120) }}
                        </p>
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        <span
                            class="text-xs px-2 py-1 rounded-full 
                            {{ $c->aktif ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                            {{ $c->aktif ? 'Aktif' : 'Nonaktif' }}
                        </span>

                        <div class="space-x-2 text-sm">
                            <a href="{{ route('carousel.edit', $c->id) }}"
                                class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-900 font-medium">
                                <x-heroicon-o-pencil-square class="w-4 h-4" /> Edit
                            </a>
                            <form id="delete-form-{{ $c->id }}" action="{{ route('carousel.destroy', $c->id) }}"
                                method="POST" class="inline-block hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button"
                                onclick="confirmDelete('{{ $c->id }}', 'Hapus {{ $c->judul }}?', 'Carousel akan dihapus permanen.')"
                                class="inline-flex items-center gap-1 text-red-600 hover:text-red-900 font-medium">
                                <x-heroicon-o-trash class="w-4 h-4" /> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $carousels->links() }}
        </div>
    @else
        <p class="text-center text-gray-500">Belum ada carousel.</p>
    @endif
</x-app-layout>

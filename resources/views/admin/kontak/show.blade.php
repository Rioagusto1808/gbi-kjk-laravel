<x-app-layout>
    <x-slot name="title">Detail Pesan Kontak</x-slot>

    <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Detail Pesan</h2>

        <div class="space-y-3">
            <p><span class="font-medium">Nama:</span> {{ $kontak->nama }}</p>
            <p><span class="font-medium">Email:</span> {{ $kontak->email }}</p>
            <p><span class="font-medium">Tanggal:</span> {{ $kontak->created_at->format('d M Y H:i') }}</p>
            <div>
                <span class="font-medium">Pesan:</span>
                <p class="mt-1 p-3 border rounded bg-gray-50">{{ $kontak->pesan }}</p>
            </div>
        </div>

        {{-- Form balasan --}}
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Balas Pesan</h3>
            <form method="POST" action="{{ route('kontak.reply', $kontak->id) }}" class="space-y-3">
                @csrf
                <textarea name="balasan" rows="4" class="w-full border-gray-300 rounded-md"
                    placeholder="Tulis balasan di sini..."></textarea>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Kirim Balasan
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

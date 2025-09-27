<x-app-layout>
    <x-slot name="title">Detail Jemaat</x-slot>

    <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Detail Jemaat</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">Nama Lengkap</p>
                <p class="font-medium">{{ $jemaat->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Jenis Kelamin</p>
                <p class="font-medium">{{ $jemaat->jenis_kelamin ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Tanggal Lahir</p>
                <p class="font-medium">{{ $jemaat->tanggal_lahir ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Alamat</p>
                <p class="font-medium">{{ $jemaat->alamat ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">No HP</p>
                <p class="font-medium">{{ $jemaat->no_hp ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Status Pernikahan</p>
                <p class="font-medium">{{ $jemaat->status_pernikahan ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Pekerjaan</p>
                <p class="font-medium">{{ $jemaat->pekerjaan ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Status</p>
                <span
                    class="px-3 py-1 inline-flex text-xs font-semibold rounded-full
                    {{ $jemaat->aktif ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $jemaat->aktif ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>
        </div>

        <div class="mt-6 flex gap-2">
            <a href="{{ route('jemaat.edit', $jemaat) }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Edit
            </a>
            <a href="{{ route('jemaat.index') }}"
                class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                Kembali
            </a>
        </div>
    </div>
</x-app-layout>

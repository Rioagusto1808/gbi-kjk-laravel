<x-app-layout>
    <x-slot name="title">{{ $pelayanan->nama }}</x-slot>

    <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">{{ $pelayanan->nama }}</h2>

            <a href="{{ url()->previous() }}"
                class="px-3 py-1 text-sm bg-gray-600 text-white rounded-md hover:bg-gray-700">
                Kembali
            </a>
        </div>

        <!-- Deskripsi -->
        <p class="text-gray-700 mb-4">
            {{ $pelayanan->deskripsi ?? 'Tidak ada deskripsi.' }}
        </p>

        <!-- Info Jemaat Count -->
        <div class="mb-4">
            <span
                class="inline-flex items-center gap-1 px-3 py-1 text-sm font-semibold rounded-full bg-indigo-100 text-indigo-700">
                <x-heroicon-o-user-group class="w-4 h-4" />
                {{ $pelayanan->jemaat->count() }} Jemaat Terlibat
            </span>
        </div>

        <!-- Daftar Jemaat -->
        @if ($pelayanan->jemaat->count())
            <div class="overflow-x-auto bg-white border rounded-lg shadow-sm">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-indigo-600 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold tracking-wider">No</th>
                            <th class="px-6 py-3 text-left font-semibold tracking-wider">Nama Jemaat</th>
                            <th class="px-6 py-3 text-left font-semibold tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left font-semibold tracking-wider">No HP</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($pelayanan->jemaat as $index => $j)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                    {{ $j->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                    {{ $j->user->email ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                    {{ $j->no_hp ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">Belum ada jemaat yang terlibat dalam pelayanan ini.</p>
        @endif
    </div>
</x-app-layout>

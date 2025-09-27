<x-app-layout>
    <x-slot name="title">Tim Pelayanan</x-slot>

    <div class="flex justify-between items-center mb-6 py-4">
        <h2 class="text-2xl font-merriweather font-semibold text-gray-800">Tim Pelayanan</h2>
    </div>

    @if ($ibadah->count())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($ibadah as $i)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-5 flex flex-col justify-between">
                    <!-- Info Ibadah -->
                    <div class="mb-3">
                        <h3 class="text-lg font-semibold text-gray-800">
                            {{ $i->jenis }} - {{ $i->lokasi ?? '-' }}
                        </h3>
                        <p class="text-sm text-gray-600">Tema : {{ $i->tema ?? '-' }}</p>
                        <p class="text-sm text-gray-500">
                            <x-heroicon-o-calendar class="w-4 h-4 inline mr-1 text-indigo-500" />
                            {{ $i->tanggal_mulai?->format('d M Y H:i') }}
                            @if ($i->tanggal_selesai)
                                - {{ $i->tanggal_selesai->format('H:i') }}
                            @endif
                        </p>
                        <p class="text-sm text-gray-500">
                            <x-heroicon-o-user class="w-4 h-4 inline mr-1 text-green-500" />
                            Gembala : {{ $i->gembala ?? '-' }}
                        </p>
                    </div>

                    <!-- Tim Pelayanan -->
                    <div class="space-y-2">
                        @forelse(($i->pelayananIbadah ?? collect()) as $t)
                            <div class="flex justify-between text-sm bg-gray-50 px-3 py-1 rounded">
                                <span class="font-medium text-gray-700">{{ $t->pelayanan->nama ?? '-' }}</span>
                                <span class="text-gray-600">{{ $t->jemaat->name ?? '-' }}</span>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">Belum ada tim pelayanan.</p>
                        @endforelse
                    </div>

                    <!-- Status Ibadah -->
                    <div class="mt-4">
                        @php
                            $color = match ($i->status) {
                                'Akan Datang' => 'bg-yellow-100 text-yellow-700',
                                'Sedang Berlangsung' => 'bg-blue-100 text-blue-700',
                                'Selesai' => 'bg-green-100 text-green-700',
                                default => 'bg-gray-100 text-gray-700',
                            };
                        @endphp
                        <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $color }}">
                            {{ $i->status }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $ibadah->links() }}
        </div>
    @else
        <p class="text-center text-gray-500">Belum ada jadwal tim pelayanan.</p>
    @endif
</x-app-layout>

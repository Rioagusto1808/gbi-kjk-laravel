<x-app-layout>
    <!-- Heading -->
    <div class="mb-8">
        <h1 class="text-xl md:text-3xl font-bold text-orange-600">Selamat Datang, {{ auth()->user()->name }}</h1>
        <p class="text-sm md:text-xl text-gray-600 mt-1">Semoga harimu diberkati dan penuh semangat ✨</p>
    </div>

    <!-- Grid Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card: Total Jemaat -->
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-indigo-500 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm text-gray-500 font-medium uppercase">Total Jemaat</h2>
                    <p class="mt-2 text-3xl font-bold text-indigo-600">{{ \App\Models\Jemaat::count() }}</p>
                </div>
                <div class="bg-indigo-100 text-indigo-600 rounded-full p-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2h5m6-8a4 4 0 100-8 4 4 0 000 8z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Card: Event -->
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-purple-500 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm text-gray-500 font-medium uppercase">Event</h2>
                    <p class="mt-2 text-3xl font-bold text-purple-600">{{ \App\Models\Event::count() }}</p>
                </div>
                <div class="bg-purple-100 text-purple-600 rounded-full p-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Card: Ibadah -->
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-500 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm text-gray-500 font-medium uppercase">Ibadah</h2>
                    <p class="mt-2 text-3xl font-bold text-green-600">{{ \App\Models\Ibadah::count() }}</p>
                </div>
                <div class="bg-green-100 text-green-600 rounded-full p-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 10h11M9 21V3M17 16l4-4m0 0l-4-4m4 4H11" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Card: Saldo Keuangan -->
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-yellow-500 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm text-gray-500 font-medium uppercase">Saldo Keuangan</h2>
                    <p class="mt-2 text-3xl font-bold text-yellow-600">
                        Rp{{ number_format(\App\Models\KeuanganTransaksi::sum('jumlah'), 0, ',', '.') }}
                    </p>
                </div>
                <div class="bg-yellow-100 text-yellow-600 rounded-full p-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8c-1.1 0-2 .9-2 2s.9 2 2 2m0-6a6 6 0 016 6c0 3.31-2.69 6-6 6m0-18v2m0 16v2m8-10h2m-18 0H2" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

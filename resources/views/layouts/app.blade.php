<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: false }" x-cloak>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'GBI KJK') }}</title>
    <link rel="icon" href="{{ asset('images/logo-gbi.jpg') }}" type="image/jpg">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AlpineJS (if not yet loaded via Vite) -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="font-sans antialiased bg-orange-50 text-gray-800">
    <div class="min-h-screen overflow-hidden">

        <!-- ✅ HEADER (fixed top) -->
        <header class="fixed top-0 left-0 right-0 h-16 bg-white shadow z-40 flex items-center px-6">
            <!-- Left Section -->
            <div class="flex items-center gap-3">
                <button class="md:hidden text-gray-700" @click="sidebarOpen = !sidebarOpen">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <a href="{{ route('home') }}"
                    class="text-xl sm:text-2xl font-semibold font-merriweather tracking-wide text-orange-500 uppercase">GBI
                    KJK</a>
            </div>

            <!-- Spacer -->
            <div class="flex-1"></div>

            <!-- Right Section -->
            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-4">
                @if (auth()->user()->jemaat && auth()->user()->jemaat->foto)
                    {{-- Foto dari storage --}}
                    <img src="{{ asset('storage/' . auth()->user()->jemaat->foto->path) }}" alt="Foto Profil"
                        class="w-12 h-12 rounded-full object-cover border border-gray-300">
                @else
                    <img src="{{ asset('images/default_profile.jpg') }}" alt="Foto Profil"
                        class="w-12 h-12 rounded-full object-cover border border-gray-300">
                @endif
            </a>

        </header>

        <!-- ✅ LAYOUT: SIDEBAR & CONTENT -->
        <div class="pt-16 flex">

            <!-- ✅ SIDEBAR (fixed) -->
            <aside x-cloak x-init="$watch('sidebarOpen', value => document.body.classList.toggle('overflow-hidden', value))"
                class="fixed top-16 left-0 z-30 w-64 h-[calc(100vh-4rem)] bg-white shadow-md transform transition-transform duration-300 ease-in-out
                md:translate-x-0"
                :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">

                <div class="p-6">
                    <nav class="space-y-4 text-sm font-medium">
                        @hasanyrole('superadmin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center gap-2 text-gray-700 hover:text-orange-600">
                                <x-heroicon-o-home class="w-5 h-5" />
                                Beranda
                            </a>
                            <a href="{{ route('jemaat.index') }}"
                                class="flex items-center gap-2 text-gray-700 hover:text-orange-600">
                                <x-heroicon-o-users class="w-5 h-5" />
                                Jemaat
                            </a>
                            <a href="{{ route('ibadah.index') }}"
                                class="flex items-center gap-2 text-gray-700 hover:text-orange-600">
                                <x-heroicon-o-calendar class="w-5 h-5" />
                                Jadwal Ibadah
                            </a>
                            <a href="{{ route('renungan.index') }}"
                                class="flex items-center gap-2 text-gray-700 hover:text-orange-600">
                                <x-heroicon-o-book-open class="w-5 h-5" />
                                Renungan
                            </a>
                            <a href="{{ route('pelayanan.index') }}"
                                class="flex items-center gap-2 text-gray-700 hover:text-orange-600">
                                <x-heroicon-o-hand-raised class="w-5 h-5" />
                                Kategori Pelayanan
                            </a>
                            <a href="{{ route('berita.index') }}"
                                class="flex items-center gap-2 text-gray-700 hover:text-orange-600">
                                <x-heroicon-o-newspaper class="w-5 h-5" />
                                Berita
                                <a href="{{ route('galeri.index') }}"
                                    class="flex items-center gap-2 text-gray-700 hover:text-orange-600">
                                    <x-heroicon-o-rectangle-stack class="w-5 h-5" />
                                    Galeri
                                </a>
                            </a>
                            <a href="{{ route('event.index') }}"
                                class="flex items-center gap-2 text-gray-700 hover:text-orange-600">
                                <x-heroicon-o-sparkles class="w-5 h-5" />
                                Event
                            </a>

                            <a href="#" class="flex items-center gap-2 text-gray-700 hover:text-orange-600">
                                <x-heroicon-o-banknotes class="w-5 h-5" />
                                Keuangan
                            </a>
                            <a href="{{ route('kontak.index') }}"
                                class="flex items-center gap-2 text-gray-700 hover:text-orange-600">
                                <x-heroicon-o-envelope class="w-5 h-5" />
                                Pesan
                            </a>
                            <a href="{{ route('carousel.index') }}"
                                class="flex items-center gap-2 text-gray-700 hover:text-orange-600">
                                <x-heroicon-o-photo class="w-5 h-5" />
                                Carousel
                            </a>
                        @endhasanyrole
                        @role('jemaat')
                            <a href="{{ route('jemaat.dashboard') }}"
                                class="flex items-center gap-2 text-gray-700 hover:text-orange-600">
                                <x-heroicon-o-home class="w-5 h-5" />
                                Beranda
                            </a>
                            <a href="{{ route('jemaat.tim-pelayanan.overview') }}"
                                class="flex items-center gap-2 text-gray-700 hover:text-orange-600">
                                <x-heroicon-o-calendar class="w-5 h-5" />
                                Tim Pelayanan
                            </a>
                            <a href="{{ route('jemaat.renungan.index') }}"
                                class="flex items-center gap-2 text-gray-700 hover:text-orange-600">
                                <x-heroicon-o-book-open class="w-5 h-5" />
                                Renungan
                            </a>
                            <a href="{{ route('jemaat.event.index') }}"
                                class="flex items-center gap-2 text-gray-700 hover:text-orange-600">
                                <x-heroicon-o-sparkles class="w-5 h-5" />
                                Event
                            </a>
                        @endrole
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-2 text-gray-700 hover:text-orange-600 w-full">
                                <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5" />
                                Keluar
                            </button>
                        </form>
                    </nav>
                </div>
            </aside>

            <!-- ✅ MAIN CONTENT -->
            <main class="flex-1 ml-0 md:ml-64 p-6 bg-orange-50 min-h-screen overflow-y-auto w-full">
                {{ $slot }}
            </main>
        </div>

        <!-- ✅ MOBILE OVERLAY -->
        <div class="fixed inset-0 bg-black bg-opacity-30 z-20 md:hidden" x-show="sidebarOpen" x-cloak
            @click="sidebarOpen = false"></div>
    </div>
    <!-- SweetAlert -->
    <script>
        function confirmDelete(id, title, text) {
            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
    @stack('scripts')
</body>

</html>

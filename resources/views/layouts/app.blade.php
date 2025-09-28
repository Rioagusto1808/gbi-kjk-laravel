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
            <div class="flex items-center gap-6" x-data="{ openNotif: false }" @click.outside="openNotif = false">

                @role('superadmin')
                    <!-- 🔔 Notifikasi -->
                    <div class="relative">
                        <button @click="openNotif = !openNotif" class="text-gray-600 hover:text-orange-500 relative">
                            <!-- Ikon lonceng -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M10.5 8.25h3l-3 4.5h3" />
                            </svg>

                            <!-- Badge jumlah unread -->
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <span
                                    class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </button>
                        <div x-show="openNotif" x-transition
                            class="fixed mt-10 sm:mr-10 inset-0 z-50 flex items-start sm:items-start justify-center sm:justify-end px-4 sm:px-0"
                            @keydown.escape.window="openNotif = false">

                            <!-- Background hitam transparan -->
                            <div class="fixed inset-0 bg-black bg-opacity-30 sm:hidden" @click="openNotif = false"></div>

                            <!-- Box Notifikasi -->
                            <div
                                class="relative mt-20 sm:mt-3 w-full sm:w-96 max-w-md bg-white rounded-lg shadow-lg border border-gray-200">
                                <div class="p-4 border-b font-semibold text-gray-700 flex justify-between items-center">
                                    <span>Notifikasi</span>
                                    @if (auth()->user()->unreadNotifications->count() > 0)
                                        <form method="POST" action="{{ route('notifications.readall') }}">
                                            @csrf
                                            <button type="submit" class="text-xs text-indigo-600 hover:underline">
                                                Tandai semua sudah dibaca
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                <ul class="max-h-80 overflow-y-auto divide-y divide-gray-200">
                                    @forelse(auth()->user()->notifications->take(7) as $notif)
                                        <li
                                            class="p-4 hover:bg-gray-50 transition flex items-start gap-3 
                    {{ is_null($notif->read_at) ? 'bg-orange-50 border-l-4 border-orange-400' : '' }}">
                                            <div class="flex-shrink-0 mt-1">
                                                @if (is_null($notif->read_at))
                                                    <span class="w-3 h-3 bg-orange-500 rounded-full inline-block"></span>
                                                @else
                                                    <span class="w-3 h-3 bg-gray-300 rounded-full inline-block"></span>
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <a href="{{ $notif->data['url'] ?? '#' }}" class="block hover:underline">
                                                    <div class="flex justify-between items-center">
                                                        <p class="text-sm font-semibold text-gray-800">
                                                            {{ $notif->data['nama'] }}
                                                        </p>
                                                        <span class="text-[11px] text-gray-400">
                                                            {{ $notif->created_at->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                    <p class="text-xs text-gray-600">{{ $notif->data['email'] }}</p>
                                                    <p class="mt-1 text-sm text-gray-700 leading-snug">
                                                        {{ $notif->data['pesan'] }}</p>
                                                </a>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="p-6 text-center text-gray-500 text-sm">
                                            Belum ada notifikasi.
                                        </li>
                                    @endforelse
                                </ul>

                                <div class="p-3 text-center border-t">
                                    <a href="{{ route('notifications.all') }}"
                                        class="text-xs text-indigo-600 hover:underline">
                                        Lihat Semua →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endrole

                <!-- Foto Profil -->
                <a href="{{ route('profile.edit') }}" class="flex items-center">
                    @if (auth()->user()->jemaat && auth()->user()->jemaat->foto)
                        <img src="{{ asset('storage/' . auth()->user()->jemaat->foto->path) }}" alt="Foto Profil"
                            class="w-12 h-12 rounded-full object-cover border border-gray-300">
                    @else
                        <img src="{{ asset('images/default_profile.jpg') }}" alt="Foto Profil"
                            class="w-12 h-12 rounded-full object-cover border border-gray-300">
                    @endif
                </a>
            </div>

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
                                class="flex items-center gap-2 {{ request()->routeIs('admin.dashboard')
                                    ? 'text-orange-600 font-semibold'
                                    : 'text-gray-700 hover:text-orange-600' }}">
                                <x-heroicon-o-home class="w-5 h-5" />
                                Beranda
                            </a>
                            <a href="{{ route('jemaat.index') }}"
                                class="flex items-center gap-2 {{ request()->routeIs('jemaat.index') ? 'text-orange-600 font-semibold' : 'text-gray-700 hover:text-orange-600' }}">
                                <x-heroicon-o-users class="w-5 h-5" />
                                Jemaat
                            </a>
                            <a href="{{ route('ibadah.index') }}"
                                class="flex items-center gap-2 {{ request()->routeIs('ibadah.index') ? 'text-orange-600 font-semibold' : 'text-gray-700 hover:text-orange-600' }}">
                                <x-heroicon-o-calendar class="w-5 h-5" />
                                Jadwal Ibadah
                            </a>
                            <a href="{{ route('renungan.index') }}"
                                class="flex items-center gap-2 {{ request()->routeIs('renungan.index')
                                    ? 'text-orange-600 font-semibold'
                                    : 'text-gray-700 hover:text-orange-600' }}">
                                <x-heroicon-o-book-open class="w-5 h-5" />
                                Renungan
                            </a>
                            <a href="{{ route('pelayanan.index') }}"
                                class="flex items-center gap-2 {{ request()->routeIs('pelayanan.index')
                                    ? 'text-orange-600 font-semibold'
                                    : 'text-gray-700 hover:text-orange-600' }}">
                                <x-heroicon-o-hand-raised class="w-5 h-5" />
                                Kategori Pelayanan
                            </a>
                            <a href="{{ route('berita.index') }}"
                                class="flex items-center gap-2 {{ request()->routeIs('berita.index') ? 'text-orange-600 font-semibold' : 'text-gray-700 hover:text-orange-600' }}">
                                <x-heroicon-o-newspaper class="w-5 h-5" />
                                Berita
                                <a href="{{ route('galeri.index') }}"
                                    class="flex items-center gap-2 {{ request()->routeIs('galeri.index') ? 'text-orange-600 font-semibold' : 'text-gray-700 hover:text-orange-600' }}">
                                    <x-heroicon-o-rectangle-stack class="w-5 h-5" />
                                    Galeri
                                </a>
                            </a>
                            <a href="{{ route('event.index') }}"
                                class="flex items-center gap-2 {{ request()->routeIs('event.index') ? 'text-orange-600 font-semibold' : 'text-gray-700 hover:text-orange-600' }}">
                                <x-heroicon-o-sparkles class="w-5 h-5" />
                                Event
                            </a>
                            <!-- <a href="#" class="flex items-center gap-2 {{ request()->routeIs('admin.dashboard')
                                ? 'text-orange-600 font-semibold'
                                : 'text-gray-700 hover:text-orange-600' }}">
                                            <x-heroicon-o-banknotes class="w-5 h-5" />
                                            Keuangan
                                        </a> -->
                            <a href="{{ route('kontak.index') }}"
                                class="flex items-center gap-2 {{ request()->routeIs('kontak.index') ? 'text-orange-600 font-semibold' : 'text-gray-700 hover:text-orange-600' }}">
                                <x-heroicon-o-envelope class="w-5 h-5" />
                                Pesan
                            </a>
                            <a href="{{ route('carousel.index') }}"
                                class="flex items-center gap-2 {{ request()->routeIs('carousel.index')
                                    ? 'text-orange-600 font-semibold'
                                    : 'text-gray-700 hover:text-orange-600' }}">
                                <x-heroicon-o-photo class="w-5 h-5" />
                                Carousel
                            </a>
                        @endhasanyrole
                        @role('jemaat')
                            <a href="{{ route('jemaat.dashboard') }}"
                                class="flex items-center gap-2 {{ request()->routeIs('jemaat.dashboard')
                                    ? 'text-orange-600 font-semibold'
                                    : 'text-gray-700 hover:text-orange-600' }}">
                                <x-heroicon-o-home class="w-5 h-5" />
                                Beranda
                            </a>
                            <a href="{{ route('jemaat.tim-pelayanan.overview') }}"
                                class="flex items-center gap-2 {{ request()->routeIs('jemaat.tim-pelayanan.overview')
                                    ? 'text-orange-600 font-semibold'
                                    : 'text-gray-700 hover:text-orange-600' }}">
                                <x-heroicon-o-calendar class="w-5 h-5" />
                                Tim Pelayanan
                            </a>
                            <a href="{{ route('jemaat.renungan.index') }}"
                                class="flex items-center gap-2 {{ request()->routeIs('jemaat.renungan.index')
                                    ? 'text-orange-600 font-semibold'
                                    : 'text-gray-700 hover:text-orange-600' }}">
                                <x-heroicon-o-book-open class="w-5 h-5" />
                                Renungan
                            </a>
                            <a href="{{ route('jemaat.event.index') }}"
                                class="flex items-center gap-2 {{ request()->routeIs('jemaat.event.index')
                                    ? 'text-orange-600 font-semibold'
                                    : 'text-gray-700 hover:text-orange-600' }}">
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

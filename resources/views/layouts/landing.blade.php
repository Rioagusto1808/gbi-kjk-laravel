<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'GBI KJK') }}</title>
    @vite('resources/css/app.css')
    @stack('styles')
    <link rel="icon" href="{{ asset('images/logo-gbi.jpg') }}" type="image/jpg">
    <meta name="description"
        content="GBI KJK adalah gereja sel apostolik dan profetik, dipenuhi kuasa Roh Kudus, bergerak dalam Amanat Agung untuk menjadikan semua bangsa murid Kristus.">
    <meta name="keywords" content="GBI KJK, Gereja, Ibadah, Kotabumi, Lampung, Renungan, Event, Berita">
    <meta name="author" content="GBI KJK">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="antialiased text-gray-800 flex flex-col min-h-screen">

    {{-- Navbar --}}
    <header class="fixed w-full z-50 bg-white/90 backdrop-blur border-b border-gray-200">
        <div class="container mx-auto px-6 flex items-center justify-between h-16">
            {{-- Logo --}}
            <a href="/" class="text-2xl font-extrabold text-red-700">GBI KJK</a>

            {{-- Menu Desktop --}}
            <nav class="hidden md:flex space-x-6 font-medium text-gray-700">
                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'text-red-700 font-bold' : 'text-gray-700 hover:text-red-700' }}">Beranda</a>
                <a href="{{ route('berita.public.index') }}"
                    class="{{ request()->routeIs('berita.public.index') ? 'text-red-700 font-bold' : 'text-gray-700 hover:text-red-700' }}">Berita</a>
                <a href="{{ route('renungan.public.index') }}"
                    class="{{ request()->routeIs('renungan.public.index') ? 'text-red-700 font-bold' : 'text-gray-700 hover:text-red-700' }}">Renungan</a>
                <a href="{{ route('jadwal.public.index') }}"
                    class="{{ request()->routeIs('jadwal.public.index') ? 'text-red-700 font-bold' : 'text-gray-700 hover:text-red-700' }}">Jadwal</a>
                <a href="{{ route('event.public.index') }}"
                    class="{{ request()->routeIs('event.public.index') ? 'text-red-700 font-bold' : 'text-gray-700 hover:text-red-700' }}">Event</a>
            </nav>

            {{-- Right side --}}
            <div class="hidden md:block">
                @guest
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 bg-red-700 text-white rounded hover:bg-red-800 transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="ml-2 px-4 py-2 border border-red-700 text-red-700 rounded hover:bg-red-100 transition">
                        Daftar
                    </a>
                @endguest

                @auth
                    <a href="{{ route('dashboard') }}"
                        class="px-4 py-2 bg-white-700 text-red-800 border border-red-800 rounded hover:bg-red-800 hover:text-white transition">
                        Dashboard
                    </a>
                @endauth
            </div>

            {{-- Mobile button --}}
            <button id="menu-toggle" class="md:hidden text-gray-700 text-2xl">
                ☰
            </button>
        </div>

        {{-- Mobile menu --}}
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
            <nav class="flex flex-col space-y-2 p-4">
                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'text-red-700 font-bold' : 'text-gray-700 hover:text-red-700' }}">Beranda</a>
                <a href="{{ route('berita.public.index') }}"
                    class="{{ request()->routeIs('berita.public.index') ? 'text-red-700 font-bold' : 'text-gray-700 hover:text-red-700' }}">Berita</a>
                <a href="{{ route('renungan.public.index') }}"
                    class="{{ request()->routeIs('renungan.public.index') ? 'text-red-700 font-bold' : 'text-gray-700 hover:text-red-700' }}">Renungan</a>
                <a href="{{ route('jadwal.public.index') }}"
                    class="{{ request()->routeIs('jadwal.public.index') ? 'text-red-700 font-bold' : 'text-gray-700 hover:text-red-700' }}">Jadwal</a>
                <a href="{{ route('event.public.index') }}"
                    class="{{ request()->routeIs('event.public.index') ? 'text-red-700 font-bold' : 'text-gray-700 hover:text-red-700' }}">Event</a>
                @guest
                    <div class="flex">
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 bg-red-700 text-white rounded hover:bg-red-800 transition">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                            class="ml-2 px-4 py-2 border border-red-700 text-red-700 rounded hover:bg-red-100 transition">
                            Daftar
                        </a>
                    </div>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="w-[110px] px-4 py-2 bg-white-700 text-red-800 border border-red-800 rounded hover:bg-red-800 hover:text-white transition">
                        Dashboard
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    {{-- Content --}}
    <main class="flex-1 pt-16">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gradient-to-r from-red-800 to-red-700 text-gray-300">
        <div class="container mx-auto px-6 py-12 grid md:grid-cols-3 gap-10">

            <div>
                <h3 class="font-bold text-white text-5xl mb-3">GBI KJK</h3>
                <p class="text-sm leading-relaxed">
                    GBI KJK adalah gereja sel apostolik dan profetik, dipenuhi kuasa Roh Kudus,
                    bergerak dalam Amanat Agung untuk menjadikan semua bangsa murid Kristus.
                </p>
            </div>

            <div>
                <h3 class="font-bold text-white text-lg mb-3">Navigasi</h3>
                <ul class="space-y-2">
                    <li><a href="#berita" class="hover:underline">Berita</a></li>
                    <li><a href="#renungan" class="hover:underline">Renungan</a></li>
                    <li><a href="#jadwal" class="hover:underline">Jadwal Ibadah</a></li>
                    <li><a href="#event" class="hover:underline">Event</a></li>
                    <li><a href="#kontak" class="hover:underline">Kontak</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold text-white text-lg mb-3">Kontak</h3>
                <p>Jl. Jodipati No.03 Prokimal, Kotabumi, Lampung Utara, Lampung.</p>
                <p>Telp: (021) 123456</p>
                <p>Email: info@gbikjk.or.id</p>
                <div class="flex space-x-4 mt-4 text-gray-300">
                    {{-- Facebook --}}
                    <a href="#" target="_blank" class="hover:text-blue-500 transition">
                        <i class="bi bi-facebook text-2xl"></i>
                        <span class="sr-only">Facebook</span>
                    </a>

                    {{-- Instagram --}}
                    <a href="https://www.instagram.com/gbijodipati?utm_source=ig_web_button_share_sheet&igsh=OHBtZnByenIxdTk0"
                        target="_blank" class="hover:text-pink-500 transition">
                        <i class="bi bi-instagram text-2xl"></i>
                        <span class="sr-only">Instagram</span>
                    </a>

                    {{-- TikTok --}}
                    <a href="https://www.tiktok.com/@gbi.kjk?is_from_webapp=1&sender_device=pc" target="_blank"
                        class="hover:text-black transition">
                        <i class="bi bi-tiktok text-2xl"></i>
                        <span class="sr-only">Tiktok</span>
                    </a>
                </div>

            </div>
        </div>
        <div class="bg-red-900 text-center py-3 text-sm text-gray-400">
            © {{ date('Y') }} GBI KJK. All Rights Reserved.
        </div>
    </footer>

    @stack('scripts')
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        AOS.init({
            duration: 1000, // durasi animasi (ms)
            once: false, // animasi hanya jalan sekali
        });
    </script>
</body>

</html>

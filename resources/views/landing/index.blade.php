@extends('layouts.landing')

@section('content')
    {{-- Hero Carousel --}}
    <section class="relative" id="hero">
        <div id="carousel" class="relative overflow-hidden w-full h-[640px]">
            <div id="carousel-inner" class="flex transition-transform duration-700 ease-in-out">
                @foreach ($carousels as $c)
                    <div class="min-w-full">
                        <img src="{{ Storage::url($c->image) }}" class="w-full h-[640px] object-cover"
                            alt="{{ $c->judul ?? 'Carousel' }}">
                    </div>
                @endforeach
            </div>

            {{-- Overlay teks tetap --}}
            <div class="p-2 absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                <div class="text-center text-white">
                    <h1 data-aos="fade-up" class="text-4xl md:text-6xl font-bold">Selamat Datang di GBI KJK</h1>
                    <p data-aos="fade-up" class="mt-4 text-lg md:text-2xl">Dimana Iman Bertumbuh dan Kasih Kristus Nyata</p>
                </div>
            </div>

            {{-- Tombol navigasi (opsional) --}}
            <!-- <button onclick="prevSlide()"
                                class="absolute top-1/2 left-4 -translate-y-1/2 bg-black/40 text-white px-3 py-2 rounded-full">‹</button>
                            <button onclick="nextSlide()"
                                class="absolute top-1/2 right-4 -translate-y-1/2 bg-black/40 text-white px-3 py-2 rounded-full">›</button> -->
        </div>
    </section>

    {{-- Text berjalan (marquee style) --}}
    <div class="overflow-hidden bg-red-700 text-white py-2">
        <div class="flex whitespace-nowrap animate-marquee">
            <span class="mx-8">TAHUN KEMENANGAN DAN BERKAT INTERNASIONAL</span>
            <span class="mx-8">TAHUN KEMENANGAN DAN BERKAT INTERNASIONAL</span>
            <span class="mx-8">TAHUN KEMENANGAN DAN BERKAT INTERNASIONAL</span>
            <span class="mx-8">TAHUN KEMENANGAN DAN BERKAT INTERNASIONAL</span>
            <span class="mx-8">TAHUN KEMENANGAN DAN BERKAT INTERNASIONAL</span>
            <span class="mx-8">TAHUN KEMENANGAN DAN BERKAT INTERNASIONAL</span>
            <span class="mx-8">TAHUN KEMENANGAN DAN BERKAT INTERNASIONAL</span>
            <span class="mx-8">TAHUN KEMENANGAN DAN BERKAT INTERNASIONAL</span>
        </div>
    </div>

    {{-- Visi & Misi --}}
    <section id="visi-misi" class="container mx-auto px-6 py-16 grid md:grid-cols-2 gap-10 items-center">

        <!-- Gambar -->
        <div data-aos="zoom-in" data-aos-duration="1200">
            <img src="/images/visi.jpg" alt="Visi Misi" class="rounded-lg shadow-lg">
        </div>

        <!-- Teks -->
        <div>
            <div class="mb-6" data-aos="fade-left" data-aos-duration="1000">
                <h3 class="lg:text-4xl text-2xl font-semibold">VISI</h3>
                <p class="lg:text-2xl text-xl font-bold text-blue-800 mt-2">MENJADI SEPERTI KRISTUS</p>
                <p class="lg:text-xl font-bold text-black mt-2">
                    Visi Kualitatif: Jemaat GBI di seluruh dunia diarahkan untuk semakin serupa dengan Kristus.
                </p>
                <p class="lg:text-xl font-bold text-black mt-2">
                    Visi Kuantitatif: Mencapai 10.000 jemaat GBI di seluruh dunia.
                </p>
            </div>

            <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="300">
                <h3 class="lg:text-4xl text-2xl font-semibold">MISI</h3>
                <p class="lg:text-xl font-bold text-black mt-2">Memberitakan kabar keselamatan kepada segala bangsa.</p>
                <p class="lg:text-xl font-bold text-black mt-2">Menjadikan orang percaya sebagai murid Kristus.</p>
                <p class="lg:text-xl font-bold text-black mt-2">Melengkapi orang percaya untuk pekerjaan pelayanan bagi
                    pembangunan Tubuh Kristus.</p>
                <p class="lg:text-xl font-bold text-black mt-2">Meningkatkan persatuan dan kesatuan Tubuh Kristus.</p>
            </div>
        </div>
    </section>

    {{-- Tentang GBI --}}
    <section id="tentang-gbi" class="relative bg-gray-900 text-white py-20 bg-cover bg-center"
        style="background-image: url('/images/gbi-bg.webp');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="relative container mx-auto px-6 text-center max-w-3xl">
            <h2 data-aos="zoom-in" class="text-4xl font-bold mb-6">Tentang GBI</h2>
            <p data-aos="fade-up" data-aos-delay="200" class="leading-relaxed">
                Gereja Bethel Indonesia (GBI) adalah sinode gereja Kristen Pentakosta/Karismatik di Indonesia,
                resmi berdiri pada 6 Oktober 1970 dan diakui pemerintah melalui SK Menteri Agama No. 41/1972.
            </p>
            <p data-aos="fade-up" data-aos-delay="400" class="mt-4 leading-relaxed">
                Visi GBI adalah <strong>Menjadi Seperti Kristus</strong> dan misi utamanya adalah menjadikan semua bangsa
                murid Kristus. Saat ini GBI telah berkembang menjadi salah satu sinode terbesar di Indonesia dengan jemaat
                yang tersebar hingga ke mancanegara.
            </p>
        </div>
    </section>

    {{-- Berita --}}
    <section id="berita" class="container mx-auto px-6 py-12">
        <h2 data-aos="fade-up" class="text-3xl font-bold mb-6 text-center">Berita Terbaru</h2>

        {{-- Wrapper untuk horizontal scroll di mobile --}}
        <div class="flex space-x-4 overflow-x-auto pb-4 md:grid md:grid-cols-2 lg:grid-cols-4 md:gap-6 md:space-x-0">
            @forelse ($berita as $index => $b)
                <div data-aos="fade-up" data-aos-delay="{{ $index * 100 }}" data-aos-duration="800"
                    class="bg-white shadow rounded overflow-hidden min-w-[250px] md:min-w-0 hover:shadow-xl hover:-translate-y-1 transform transition">

                    {{-- gambar --}}
                    @if ($b->files->count())
                        <img src="{{ Storage::url($b->files->first()->path) }}" alt="{{ $b->judul }}"
                            class="w-full h-48 object-cover">
                    @else
                        <img src="{{ asset('images/no-image.jpg') }}" alt="No Image" class="w-full h-48 object-cover">
                    @endif

                    {{-- konten --}}
                    <div class="p-4">
                        <div class="flex justify-between items-center">
                            <h3 class="font-bold text-lg mb-1">{{ $b->judul }}</h3>
                            <p class="text-xs text-gray-500">
                                {{ $b->author->name ?? 'Anonim' }}
                            </p>
                        </div>

                        <p class="text-xs text-gray-500 mb-2">
                            @if ($b->published_at)
                                {{ $b->published_at->translatedFormat('d F Y | H:i') }} WIB
                            @else
                                <span class="italic text-gray-400">Belum dipublikasikan</span>
                            @endif
                        </p>

                        <p class="text-sm text-gray-700 line-clamp-3">
                            {{ Str::limit(strip_tags($b->isi ?? ''), 120) }}
                        </p>

                        <a href="{{ route('berita.public.show', $b->id) }}"
                            class="text-red-700 font-medium mt-3 inline-block">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-4">Belum ada berita tersedia.</p>
            @endforelse
        </div>

        {{-- Tombol Lebih Banyak --}}
        @if ($berita->count() > 0)
            <div data-aos="fade-up" data-aos-delay="200" class="mt-8 text-center">
                <a href="{{ route('berita.public.index') }}"
                    class="inline-block md:px-6 px-3 md:py-3 py-1 bg-red-700 text-white font-semibold rounded-lg shadow text-xs md:text-2xl hover:bg-red-800 transition">
                    Lebih Banyak Berita
                </a>
            </div>
        @endif
    </section>

    {{-- Renungan --}}
    <section id="renungan" class="bg-gray-200 px-6 py-12">
        <h2 data-aos="zoom-in" class="text-3xl font-bold mb-6 text-center">Renungan Harian</h2>

        {{-- Wrapper scroll di mobile, grid di tablet/desktop --}}
        <div class="flex space-x-4 overflow-x-auto pb-4 md:grid md:grid-cols-2 lg:grid-cols-4 md:gap-6 md:space-x-0">
            @forelse ($renungan as $index => $r)
                <div data-aos="fade-up" data-aos-delay="{{ $index * 150 }}" data-aos-duration="800"
                    class="bg-white shadow rounded p-6 flex flex-col justify-between min-w-[250px] md:min-w-0 hover:shadow-lg hover:-translate-y-1 transform transition">

                    <div>
                        <h3 class="font-bold text-xl text-gray-800">{{ $r->judul }}</h3>

                        {{-- Ayat --}}
                        <p class="text-sm text-indigo-600 italic mt-1">"{{ $r->ayat ?? '-' }}"</p>

                        {{-- Isi singkat --}}
                        <p class="text-gray-700 mt-3">
                            {{ Str::limit(strip_tags($r->isi), 120) }}
                        </p>
                    </div>

                    {{-- Penulis & tanggal --}}
                    <div class="mt-4 text-sm text-gray-500 flex justify-between">
                        <p>{{ $r->created_at->translatedFormat('d F Y | H:i') }} WIB</p>
                        <p class="font-medium">✍️ {{ $r->penulis ?? 'Admin' }}</p>
                    </div>

                    <a href="{{ route('renungan.public.show', $r->id) }}" class="text-red-700 font-medium mt-3 block">
                        Baca Selengkapnya →
                    </a>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-4">Belum ada renungan tersedia.</p>
            @endforelse
        </div>

        {{-- Tombol Lebih Banyak --}}
        @if ($renungan->count() > 0)
            <div data-aos="fade-up" data-aos-delay="200" class="mt-8 text-center">
                <a href="{{ route('renungan.public.index') }}"
                    class="inline-block md:px-6 px-3 md:py-3 py-1 bg-red-700 text-white text-xs md:text-2xl font-semibold rounded-lg shadow hover:bg-red-800 transition">
                    Lebih Banyak Renungan
                </a>
            </div>
        @endif
    </section>

    {{-- Jadwal Ibadah --}}
    <section id="jadwal" class="container mx-auto px-6 py-12">
        <h2 data-aos="fade-up" class="text-3xl font-bold mb-6 text-center">Jadwal Ibadah</h2>

        {{-- Scroll di mobile, grid di tablet/desktop --}}
        <div class="flex space-x-4 overflow-x-auto pb-4 md:grid md:grid-cols-2 lg:grid-cols-4 md:gap-6 md:space-x-0">
            @forelse ($jadwal as $index => $j)
                <div data-aos="fade-up" data-aos-delay="{{ $index * 150 }}" data-aos-duration="900"
                    class="bg-gray-100 shadow rounded-lg p-6 hover:shadow-lg transition min-w-[260px] md:min-w-0 flex-shrink-0">

                    <div class="flex justify-between items-center">
                        {{-- Jenis --}}
                        <h3 class="text-xl font-bold text-red-700">{{ $j->jenis }}</h3>

                        {{-- Status Badge --}}
                        <span data-aos="zoom-in" data-aos-delay="{{ $index * 150 + 100 }}"
                            class="inline-block mb-2 px-3 py-1 text-xs rounded-full
                        @if ($j->status === 'Sedang Berlangsung') bg-green-100 text-green-700
                        @elseif($j->status === 'Akan Datang') bg-yellow-100 text-yellow-700
                        @else bg-gray-200 text-gray-600 @endif">
                            {{ $j->status }}
                        </span>
                    </div>

                    {{-- Tema --}}
                    <p class="mt-1 text-gray-800 italic">Tema: {{ $j->tema ?? 'Belum tersedia' }}</p>

                    {{-- Ayat --}}
                    <p class="mt-1 text-sm text-gray-600">Ayat: {{ $j->ayat ?? '-' }}</p>

                    {{-- Gembala --}}
                    <p class="mt-1 text-sm text-gray-600">Gembala: {{ $j->gembala ?? 'Belum tersedia' }}</p>

                    {{-- Tanggal & Waktu --}}
                    <p class="mt-3 text-gray-700 font-medium">
                        {{ $j->tanggal_mulai->translatedFormat('l, d F Y') }}
                    </p>
                    <p class="text-gray-600">
                        {{ $j->tanggal_mulai->format('H:i') }} WIB -
                        {{ $j->tanggal_selesai ? $j->tanggal_selesai->format('H:i') . ' WIB' : 'Selesai' }}
                    </p>

                    {{-- Lokasi --}}
                    <p class="mt-2 flex text-sm text-gray-500 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-red-700" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        {{ $j->lokasi }}
                    </p>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-4">Belum ada jadwal ibadah tersedia.</p>
            @endforelse
        </div>

        {{-- Tombol Lebih Banyak --}}
        @if ($jadwal->count() > 0)
            <div data-aos="fade-up" data-aos-delay="200" class="mt-8 text-center">
                <a href="{{ route('jadwal.public.index') }}"
                    class="inline-block md:px-6 px-3 md:py-3 text-xs md:text-2xl bg-red-700 text-white font-semibold rounded-lg shadow hover:bg-red-800 transition">
                    Lihat Semua Jadwal
                </a>
            </div>
        @endif
    </section>

    {{-- Event --}}
    <section id="event" class="container bg-gray-200 mx-auto px-6 py-12">
        <h2 data-aos="fade-up" class="text-3xl font-bold mb-6 text-center">Event Gereja</h2>

        <div class="flex space-x-4 overflow-x-auto pb-4 md:grid md:grid-cols-2 lg:grid-cols-4 md:gap-6 md:space-x-0">
            @forelse ($event as $index => $e)
                <div data-aos="zoom-in" data-aos-delay="{{ $index * 150 }}" data-aos-duration="900"
                    class="bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition min-w-[260px] md:min-w-0 flex-shrink-0">

                    {{-- Gambar --}}
                    @if (isset($e->image))
                        <img src="{{ Storage::url($e->image) }}" alt="{{ $e->nama_event }}"
                            class="w-full h-40 object-cover">
                    @else
                        <img src="{{ asset('images/no-image.jpg') }}" alt="No Image" class="w-full h-40 object-cover">
                    @endif

                    {{-- Konten --}}
                    <div class="p-4">
                        {{-- Status --}}
                        <span data-aos="fade-in" data-aos-delay="{{ $index * 150 + 50 }}"
                            class="inline-block mb-2 px-3 py-1 text-xs rounded-full
                        @if ($e->status === 'Sedang Berlangsung') bg-green-100 text-green-700
                        @elseif($e->status === 'Akan Datang') bg-yellow-100 text-yellow-700
                        @else bg-gray-200 text-gray-600 @endif">
                            {{ $e->status }}
                        </span>

                        <h3 class="font-bold text-lg text-red-700">{{ $e->nama_event }}</h3>

                        @if ($e->tema)
                            <p class="text-sm italic text-gray-600">Tema: {{ $e->tema }}</p>
                        @endif

                        <p class="text-sm text-gray-700 mt-2">
                            {{ Str::limit(strip_tags($e->deskripsi ?? ''), 100) }}
                        </p>

                        <div class="mt-3 text-sm text-gray-500">
                            <p>📅 {{ $e->tanggal_mulai->translatedFormat('l, d F Y H:i') }}
                                @if ($e->tanggal_selesai)
                                    - {{ $e->tanggal_selesai->translatedFormat('H:i') }} WIB
                                @endif
                            </p>
                            @if ($e->lokasi)
                                <p>📍 {{ $e->lokasi }}</p>
                            @endif
                            @if ($e->biaya)
                                <p>💰 Rp{{ number_format($e->biaya, 0, ',', '.') }}</p>
                            @endif
                        </div>

                        <a href="{{ route('event.show', $e) }}" class="text-red-700 font-medium mt-3 inline-block">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-4">Belum ada event tersedia.</p>
            @endforelse
        </div>

        {{-- Tombol Lebih Banyak --}}
        @if ($event->count() > 0)
            <div data-aos="fade-up" data-aos-delay="200" class="mt-8 text-center">
                <a href="{{ route('event.public.index') }}"
                    class="inline-block px-6 py-3 bg-red-700 text-white font-semibold rounded-lg shadow hover:bg-red-800 transition">
                    Lebih Banyak Event
                </a>
            </div>
        @endif
    </section>

    {{-- Galeri --}}

    <section id="galeri" class="px-6 py-12 bg-white">
        <h2 data-aos="fade-up" class="text-3xl font-bold mb-6 text-center">Galeri Kegiatan</h2>

        <div class="relative">
            <!-- Wrapper untuk scroll -->
            <div id="galeri-scroll" class="flex space-x-4 overflow-x-auto scroll-smooth pb-4 px-12">
                @forelse ($galeri as $index => $g)
                    <div data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}" data-aos-duration="800"
                        class="min-w-[250px] md:min-w-[300px] flex-shrink-0">
                        <img src="{{ Storage::url($g->image) }}" alt="{{ $g->judul ?? 'Galeri' }}"
                            class="w-full h-60 object-cover rounded-lg shadow-md hover:scale-105 hover:shadow-xl transition duration-300">
                    </div>
                @empty
                    <div class="w-full flex justify-center items-center">
                        <p class="text-center text-gray-500">Belum ada galeri tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Kontak Kami dan Maps --}}
    <section id="kontak" class="container bg-gray-200 mx-auto px-6 py-12">
        <h2 data-aos="fade-up" class="text-3xl font-bold mb-6 text-center">Kontak Kami</h2>

        <div class="grid md:grid-cols-2 gap-8">
            <x-message />

            {{-- Form Kontak --}}
            <form action="{{ route('kontak.store') }}" method="POST" data-aos="fade-right" data-aos-duration="800"
                class="bg-white p-6 shadow rounded">
                @csrf
                <div class="mb-4">
                    <label class="block mb-1">Nama</label>
                    <input type="text" name="nama" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1">Email</label>
                    <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1">Pesan</label>
                    <textarea name="pesan" rows="4" class="w-full border rounded px-3 py-2" required></textarea>
                </div>
                <button type="submit" data-aos="zoom-in" data-aos-delay="200"
                    class="bg-red-700 text-white px-4 py-2 rounded hover:bg-red-800 transition">
                    Kirim
                </button>
            </form>

            {{-- Peta Google --}}
            <div data-aos="fade-left" data-aos-duration="800" class="rounded overflow-hidden shadow">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3975.853152402329!2d104.8282237739771!3d-4.795246195180133!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e38a5b30a2f73cd%3A0xf6b3a428ec740a07!2sGBI%20KJK-Jodipati!5e0!3m2!1sid!2sid!4v1758964689530!5m2!1sid!2sid"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        const carousel = document.getElementById('carousel-inner');
        const slides = carousel.children.length;
        let index = 0;

        function showSlide(i) {
            index = (i + slides) % slides;
            carousel.style.transform = `translateX(-${index * 100}%)`;
        }

        function nextSlide() {
            showSlide(index + 1);
        }

        function prevSlide() {
            showSlide(index - 1);
        }

        setInterval(nextSlide, 5000); // auto slide
    </script>
@endpush

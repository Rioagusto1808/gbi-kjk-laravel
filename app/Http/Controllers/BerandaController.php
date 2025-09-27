<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Carousel;
use App\Models\Event;
use App\Models\Galeri;
use App\Models\Ibadah;
use App\Models\Renungan;

class BerandaController extends Controller
{
    public function index()
    {
        $carousels = Carousel::where('aktif', 1)
        ->orderBy('urutan', 'asc')
        ->get();
        // ambil berita terbaru + relasi file (gambar)
        $berita = Berita::with('files')->latest()->take(6)->get();

        // ambil renungan terbaru
        $renungan = Renungan::latest()->take(4)->get();

        // ambil jadwal ibadah terdekat
        $jadwal = Ibadah::upcoming()->take(6)->get();

        // ambil event terbaru
        $event = Event::latest()->take(6)->get();

        $galeri = Galeri::latest()->take(6)->get();

        return view('landing.index', compact('berita', 'renungan', 'jadwal', 'event', 'carousels', 'galeri'));
    }
}

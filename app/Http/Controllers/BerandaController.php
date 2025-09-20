<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Renungan;

class BerandaController extends Controller
{
    /**
     * Halaman beranda (landing page).
     */
    public function index()
    {
        $berita = Berita::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('welcome', compact('berita'));
    }
}

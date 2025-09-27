<?php

namespace App\Http\Controllers;

use App\Models\Ibadah;
use App\Models\Renungan;

class DashboardJemaatController extends Controller
{
    /**
     * Tampilkan dashboard jemaat.
     */
    public function index()
    {
        // Renungan terbaru (publish)
        $renungan = Renungan::where('status', 'publish')
            ->latest('created_at')
            ->first();

        // Ibadah yang akan datang / sedang berlangsung
        $ibadah = Ibadah::whereIn('status', ['Akan Datang', 'Sedang Berlangsung'])
            ->orderBy('tanggal_mulai', 'asc')
            ->take(3)
            ->get();

        // (Opsional) bisa tambahkan notifikasi lain

        return view('jemaat.dashboard', compact('renungan', 'ibadah'));
    }
}

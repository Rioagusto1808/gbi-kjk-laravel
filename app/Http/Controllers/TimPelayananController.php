<?php

namespace App\Http\Controllers;

use App\Models\Ibadah;
use App\Models\Pelayanan;
use App\Models\Jemaat;
use App\Models\PelayananIbadah;
use Illuminate\Http\Request;

class TimPelayananController extends Controller
{
    /**
     * INDEX (Admin) – tampilkan daftar tim pelayanan untuk 1 ibadah.
     */
    public function index(Ibadah $ibadah)
    {
        $timPelayanan = $ibadah->pelayananIbadah()
            ->with(['pelayanan', 'jemaat'])
            ->get();

        return view('admin.tim_pelayanan.index', compact('ibadah', 'timPelayanan'));
    }

    /**
     * INDEX (Jemaat) – read-only.
     */
    public function jemaatIndex(Ibadah $ibadah)
    {
        $timPelayanan = $ibadah->pelayananIbadah()
            ->with(['pelayanan', 'jemaat'])
            ->get();

        return view('jemaat.tim_pelayanan.index', compact('ibadah', 'timPelayanan'));
    }

    /**
     * CREATE – form tambah penugasan pelayanan.
     */
    public function create(Ibadah $ibadah)
    {
        $pelayanan = Pelayanan::all(); // kategori pelayanan
        $jemaat = Jemaat::where('aktif', true)->get();

        return view('admin.tim_pelayanan.create', compact('ibadah', 'pelayanan', 'jemaat'));
    }

    /**
     * STORE – simpan tim pelayanan baru.
     */
    public function store(Request $request, Ibadah $ibadah)
    {
        $validated = $request->validate([
            'pelayanan_id' => 'required|exists:pelayanan,id',
            'jemaat_id'    => 'required|exists:jemaat,id',
        ]);

        PelayananIbadah::updateOrCreate(
            [
                'ibadah_id'    => $ibadah->id,
                'pelayanan_id' => $validated['pelayanan_id'],
            ],
            ['jemaat_id' => $validated['jemaat_id']]
        );

        return redirect()->route('tim-pelayanan.index', $ibadah->id)
            ->with('success', 'Tim pelayanan berhasil ditambahkan.');
    }

    /**
     * EDIT – form edit penugasan.
     */
    public function edit(Ibadah $ibadah, PelayananIbadah $timPelayanan)
    {
        $pelayanan = Pelayanan::all();
        $jemaat = Jemaat::where('aktif', true)->get();

        return view('admin.tim_pelayanan.edit', compact('ibadah', 'timPelayanan', 'pelayanan', 'jemaat'));
    }

    /**
     * UPDATE – simpan perubahan.
     */
    public function update(Request $request, Ibadah $ibadah, PelayananIbadah $timPelayanan)
    {
        $validated = $request->validate([
            'pelayanan_id' => 'required|exists:pelayanan,id',
            'jemaat_id'    => 'required|exists:jemaat,id',
        ]);

        $timPelayanan->update($validated);

        return redirect()->route('tim-pelayanan.index', $ibadah->id)
            ->with('success', 'Tim pelayanan berhasil diperbarui.');
    }

    /**
     * DESTROY – hapus penugasan.
     */
    public function destroy(Ibadah $ibadah, PelayananIbadah $timPelayanan)
    {
        $timPelayanan->delete();

        return redirect()->route('tim-pelayanan.index', $ibadah->id)
            ->with('success', 'Tim pelayanan berhasil dihapus.');
    }

    public function overviewJemaat()
    {
        $ibadah = Ibadah::with(['pelayananIbadah.pelayanan', 'pelayananIbadah.jemaat'])
            ->whereIn('status', ['Akan Datang', 'Sedang Berlangsung'])
            ->orderBy('tanggal_mulai', 'asc')
            ->paginate(9);

        return view('jemaat.tim_pelayanan.overview', compact('ibadah'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\PelayananRequest;
use App\Models\Pelayanan;

class PelayananController extends Controller
{
    /**
     * INDEX untuk admin/staff (CRUD).
     */
    public function index()
    {
        $pelayanan = Pelayanan::withCount('jemaat')->paginate(10);

        return view('admin.pelayanan.index', compact('pelayanan'));
    }

    /**
     * INDEX untuk jemaat (readonly).
     */
    public function jemaatIndex()
    {
        $pelayanan = Pelayanan::withCount('jemaat')->paginate(10);

        return view('jemaat.pelayanan.index', compact('pelayanan'));
    }

    /**
     * FORM CREATE – tambah pelayanan (admin).
     */
    public function create()
    {
        return view('admin.pelayanan.create');
    }

    /**
     * STORE – simpan pelayanan baru.
     */
    public function store(PelayananRequest $request)
    {
        Pelayanan::create($request->validated());

        return redirect()->route('pelayanan.index')
            ->with('success', 'Pelayanan berhasil ditambahkan.');
    }

    /**
     * SHOW – detail pelayanan (dipakai admin & jemaat).
     */
    public function show(Pelayanan $pelayanan)
    {
        $pelayanan->load('jemaat');

        return view('jemaat.pelayanan.show', compact('pelayanan'));
    }

    /**
     * FORM EDIT – edit pelayanan (admin).
     */
    public function edit(Pelayanan $pelayanan)
    {
        return view('admin.pelayanan.edit', compact('pelayanan'));
    }

    /**
     * UPDATE – perbarui pelayanan (admin).
     */
    public function update(PelayananRequest $request, Pelayanan $pelayanan)
    {
        $pelayanan->update($request->validated());

        return redirect()->route('pelayanan.index')
            ->with('success', 'Pelayanan berhasil diperbarui.');
    }

    /**
     * DESTROY – hapus pelayanan (admin).
     */
    public function destroy(Pelayanan $pelayanan)
    {
        $pelayanan->delete();

        return redirect()->route('pelayanan.index')
            ->with('success', 'Pelayanan berhasil dihapus.');
    }
}

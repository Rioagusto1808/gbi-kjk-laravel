<?php

namespace App\Http\Controllers;

use App\Http\Requests\RenunganRequest;
use App\Models\Renungan;

class RenunganController extends Controller
{
    /**
     * Jemaat (login) -> daftar renungan publish.
     */
    public function jemaatIndex()
    {
        $renungan = Renungan::where('status', 'publish')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('jemaat.renungan.index', compact('renungan'));
    }

    public function jemaatShow(Renungan $renungan)
    {
        abort_if($renungan->status !== 'publish', 403);

        return view('jemaat.renungan.show', compact('renungan'));
    }

    /**
     * Admin -> list semua renungan (CRUD).
     */
    public function index()
    {
        $renungan = Renungan::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.renungan.index', compact('renungan'));
    }

    public function create()
    {
        return view('admin.renungan.create');
    }

    public function store(RenunganRequest $request)
    {
        Renungan::create($request->validated());

        return redirect()->route('renungan.index')
            ->with('success', 'Renungan berhasil ditambahkan.');
    }

    public function edit(Renungan $renungan)
    {
        return view('admin.renungan.edit', compact('renungan'));
    }

    public function update(RenunganRequest $request, Renungan $renungan)
    {
        $renungan->update($request->validated());

        return redirect()->route('renungan.index')
            ->with('success', 'Renungan berhasil diperbarui.');
    }

    public function destroy(Renungan $renungan)
    {
        $renungan->delete();

        return redirect()->route('renungan.index')
            ->with('success', 'Renungan berhasil dihapus.');
    }
}

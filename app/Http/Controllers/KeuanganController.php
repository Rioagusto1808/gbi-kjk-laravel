<?php

namespace App\Http\Controllers;

use App\Http\Requests\KeuanganRequest;
use App\Models\KeuanganTransaksi;

class KeuanganController extends Controller
{
    public function index()
    {
        $trx = KeuanganTransaksi::with('dibuatOleh')->paginate(20);
        return response()->json($trx);
    }

    public function store(KeuanganRequest $request)
    {
        $this->authorize('create', KeuanganTransaksi::class);

        $trx = KeuanganTransaksi::create([
            ...$request->validated(),
            'dibuat_oleh' => auth()->id(),
        ]);

        return response()->json($trx, 201);
    }

    public function show(KeuanganTransaksi $trx)
    {
        return response()->json($trx->load('dibuatOleh'));
    }

    public function update(KeuanganRequest $request, KeuanganTransaksi $trx)
    {
        $this->authorize('update', $trx);

        $trx->update($request->validated());
        return response()->json($trx);
    }

    public function destroy(KeuanganTransaksi $trx)
    {
        $this->authorize('delete', $trx);

        $trx->delete();
        return response()->json(['message' => 'Transaksi keuangan dihapus']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\KeuanganRequest;
use App\Models\KeuanganTransaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class KeuanganController extends Controller
{
    public function index()
    {
        $trx = KeuanganTransaksi::with('dibuatOleh')
            ->orderByDesc('tanggal')
            ->paginate(20);

        return view('admin.keuangan.index', compact('trx'));
    }

    public function create()
    {
        return view('admin.keuangan.create');
    }

    public function store(KeuanganRequest $request)
    {
        $this->authorize('create', KeuanganTransaksi::class);

        KeuanganTransaksi::create([
            ...$request->validated(),
            'dibuat_oleh' => auth()->id(),
        ]);

        return redirect()->route('keuangan.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function show(KeuanganTransaksi $trx)
    {
        return view('admin.keuangan.show', compact('trx'));
    }

    public function edit(KeuanganTransaksi $trx)
    {
        return view('admin.keuangan.edit', compact('trx'));
    }

    public function update(KeuanganRequest $request, KeuanganTransaksi $trx)
    {
        $this->authorize('update', $trx);

        $trx->update($request->validated());

        return redirect()->route('keuangan.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(KeuanganTransaksi $trx)
    {
        $this->authorize('delete', $trx);

        $trx->delete();

        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }

    public function laporan(KeuanganTransaksi $trx)
    {
        // Filter optional (misalnya per bulan)
        $query = KeuanganTransaksi::with('dibuatOleh')
            ->orderBy('tanggal', 'desc');

        if ($trx->filled('bulan')) {
            $query->whereMonth('tanggal', $trx->bulan);
        }

        if ($trx->filled('tahun')) {
            $query->whereYear('tanggal', $trx->tahun);
        }

        $trx = $query->get();

        $pdf = Pdf::loadView('admin.keuangan.laporan-pdf', compact('trx'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('laporan-keuangan.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\IbadahRequest;
use App\Models\Ibadah;
use Illuminate\Http\Request;

class IbadahController extends Controller
{
    /**
     * Beranda publik -> list ibadah (readonly).
     */
    public function publikIndex()
    {
        $ibadah = Ibadah::whereIn('status', ['Akan Datang', 'Sedang Berlangsung'])
            ->orderBy('tanggal_mulai', 'asc')
            ->paginate(10);

        return view('ibadah.index', compact('ibadah'));
    }

    /**
     * Detail ibadah untuk publik/jemaat.
     */
    public function show(Ibadah $ibadah)
    {
        return view('jemaat.ibadah.show', compact('ibadah'));
    }

    /**
     * Dashboard jemaat -> tampilkan yang belum selesai.
     */
    public function jemaatIndex()
    {
        $ibadah = Ibadah::whereIn('status', ['Akan Datang', 'Sedang Berlangsung'])
            ->orderBy('tanggal_mulai', 'asc')
            ->get();

        return view('jemaat.ibadah.index', compact('ibadah'));
    }

    /**
     * INDEX (Admin/Staff CRUD) – dipakai oleh Route::resource di group admin/staff.
     */
    public function index(Request $request)
    {
        $query = Ibadah::whereIn('status', ['Akan Datang', 'Sedang Berlangsung']);

        if ($request->filled('search')) {
            $s = $request->string('search');
            $query->where(function ($q) use ($s) {
                $q->where('jenis', 'like', "%{$s}%")
                    ->orWhere('tema', 'like', "%{$s}%")
                    ->orWhere('lokasi', 'like', "%{$s}%")
                    ->orWhere('gembala', 'like', "%{$s}%");
            });
        }

        $ibadah = $query->orderBy('tanggal_mulai', 'desc')->paginate(10);

        return view('admin.ibadah.index', compact('ibadah'));
    }

    public function create()
    {
        return view('admin.ibadah.create');
    }

    public function store(IbadahRequest $request)
    {
        Ibadah::create($request->validated());

        return redirect()->route('ibadah.index')->with('success', 'Ibadah berhasil ditambahkan.');
    }

    public function edit(Ibadah $ibadah)
    {
        return view('admin.ibadah.edit', compact('ibadah'));
    }

    public function update(IbadahRequest $request, Ibadah $ibadah)
    {
        $ibadah->update($request->validated());

        return redirect()->route('ibadah.index')->with('success', 'Ibadah berhasil diperbarui.');
    }

    public function destroy(Ibadah $ibadah)
    {
        $ibadah->delete();

        return redirect()->route('ibadah.index')->with('success', 'Ibadah berhasil dihapus.');
    }

    public function history()
    {
        $ibadah = Ibadah::where('status', 'Selesai')
            ->orderBy('tanggal_mulai', 'desc')
            ->paginate(10);

        return view('admin.ibadah.history', compact('ibadah'));
    }
}

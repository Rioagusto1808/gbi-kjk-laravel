<?php

namespace App\Http\Controllers;

use App\Http\Requests\JemaatRequest;
use App\Models\Jemaat;
use Illuminate\Http\Request;

class JemaatController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Jemaat::class);

        $query = Jemaat::with(['foto', 'keluarga', 'pelayanan']);

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('no_hp', 'like', "%{$request->search}%");
        }

        $jemaat = $query->oldest()->paginate(10);

        return view('admin.jemaat.index', compact('jemaat'));
    }

    public function create()
    {
        $this->authorize('create', Jemaat::class);
        return view('jemaat.create');
    }

    public function store(JemaatRequest $request)
    {
        $this->authorize('create', Jemaat::class);

        Jemaat::create($request->validated());

        return redirect()->route('jemaat.index')
            ->with('success', 'Data jemaat berhasil ditambahkan.');
    }

    public function show(Jemaat $jemaat)
    {
        $this->authorize('view', $jemaat);

        return view('jemaat.show', compact('jemaat'));
    }

    public function edit(Jemaat $jemaat)
    {
        $this->authorize('update', $jemaat);

        return view('jemaat.edit', compact('jemaat'));
    }

    public function update(JemaatRequest $request, Jemaat $jemaat)
    {
        $this->authorize('update', $jemaat);

        $jemaat->update($request->validated());

        return redirect()->route('jemaat.index')
            ->with('success', 'Data jemaat berhasil diperbarui.');
    }

    public function destroy(Jemaat $jemaat)
    {
        $this->authorize('delete', $jemaat);

        $jemaat->delete();

        return redirect()->route('jemaat.index')
            ->with('success', 'Data jemaat berhasil dihapus.');
    }

    public function deleted()
    {
        $jemaat = Jemaat::onlyTrashed()->paginate(10);
        return view('jemaat.deleted', compact('jemaat'));
    }

    public function restore($id)
    {
        $jemaat = Jemaat::withTrashed()->findOrFail($id);
        $jemaat->restore();

        return redirect()->route('jemaat.deleted')->with('success', 'Jemaat berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $jemaat = Jemaat::withTrashed()->findOrFail($id);
        $jemaat->forceDelete();

        return redirect()->route('jemaat.deleted')->with('success', 'Jemaat dihapus permanen.');
    }
}

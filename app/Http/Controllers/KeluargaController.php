<?php

namespace App\Http\Controllers;

use App\Http\Requests\KeluargaRequest;
use App\Models\Keluarga;

class KeluargaController extends Controller
{
    public function index()
    {
        $keluarga = Keluarga::with(['kepala', 'anggota'])->paginate(20);

        return response()->json($keluarga);
    }

    public function store(KeluargaRequest $request)
    {
        $keluarga = Keluarga::create($request->validated());

        return response()->json($keluarga, 201);
    }

    public function show(Keluarga $keluarga)
    {
        return response()->json($keluarga->load(['kepala', 'anggota']));
    }

    public function update(KeluargaRequest $request, Keluarga $keluarga)
    {
        $keluarga->update($request->validated());

        return response()->json($keluarga);
    }

    public function destroy(Keluarga $keluarga)
    {
        $keluarga->delete();

        return response()->json(['message' => 'Keluarga dihapus']);
    }
}

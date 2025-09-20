<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotifikasiRequest;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasi = Notifikasi::latest()->paginate(20);
        return response()->json($notifikasi);
    }

    public function store(NotifikasiRequest $request)
    {
        $notif = Notifikasi::create($request->validated());
        return response()->json($notif, 201);
    }

    public function show(Notifikasi $notifikasi)
    {
        return response()->json($notifikasi);
    }

    public function update(NotifikasiRequest $request, Notifikasi $notifikasi)
    {
        $notifikasi->update($request->validated());
        return response()->json($notifikasi);
    }

    public function destroy(Notifikasi $notifikasi)
    {
        $notifikasi->delete();
        return response()->json(['message' => 'Notifikasi dihapus']);
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPeserta;
use Illuminate\Http\Request;

class EventPesertaController extends Controller
{
    /**
     * Jemaat daftar event.
     */
    public function daftar(Event $event)
    {
        $user = auth()->user();

        if (! $user || ! $user->jemaat) {
            return back()->with('error', 'Akun Anda tidak terkait dengan data jemaat.');
        }

        $jemaat = $user->jemaat;

        // Cek sudah daftar belum
        $sudahDaftar = EventPeserta::where('event_id', $event->id)
            ->where('jemaat_id', $jemaat->id)
            ->exists();

        if ($sudahDaftar) {
            return back()->with('warning', 'Anda sudah terdaftar di event ini.');
        }

        // Jika event berbayar -> status awal Daftar, kalau gratis -> langsung Dikonfirmasi
        $status = $event->biaya && $event->biaya > 0 ? 'Daftar' : 'Dikonfirmasi';

        EventPeserta::create([
            'event_id' => $event->id,
            'jemaat_id' => $jemaat->id,
            'status' => $status,
        ]);

        return back()->with('success', 'Pendaftaran event berhasil.');
    }

    /**
     * Admin lihat daftar peserta event.
     */
    public function index(Event $event)
    {
        // ambil peserta + jemaat
        $peserta = EventPeserta::with('jemaat')
            ->where('event_id', $event->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.event.peserta.index', compact('event', 'peserta'));
    }

    /**
     * Admin update status peserta (misalnya konfirmasi pembayaran).
     */
    public function updateStatus(EventPeserta $peserta, Request $request)
    {
        $request->validate([
            'status' => 'required|in:Daftar,Dikonfirmasi,Bayar,Batal',
            'hadir' => 'nullable|boolean',
        ]);

        $peserta->update([
            'status' => $request->status,
            'hadir' => $request->boolean('hadir'),
        ]);

        return back()->with('success', 'Status peserta diperbarui.');
    }
}

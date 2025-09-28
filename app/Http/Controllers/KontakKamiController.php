<?php

namespace App\Http\Controllers;

use App\Http\Requests\KontakKamiRequest;
use App\Models\KontakKami;
use App\Models\User;
use App\Notifications\PesanBaruNotif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class KontakKamiController extends Controller
{
    // 👉 Store pesan dari beranda
    public function store(KontakKamiRequest $request)
    {
        $data = $request->validated();
        $kontak = KontakKami::create($data);

        $admin = User::role('superadmin')->first();

        if ($admin) {
            $notifData = [
                'id' => $kontak->id,
                'nama' => $kontak->nama,
                'email' => $kontak->email,
                'pesan' => $kontak->pesan,
            ];
            $admin->notify(new PesanBaruNotif($notifData));
        }

        return back()->with('success', 'Pesan berhasil dikirim. Kami akan segera merespon.');
    }

    // 👉 Daftar pesan di dashboard
    public function index()
    {
        $kontak = KontakKami::latest()->paginate(10);

        return view('admin.kontak.index', compact('kontak'));
    }

    // 👉 Detail pesan
    public function show(KontakKami $kontak)
    {
        return view('admin.kontak.show', compact('kontak'));
    }

    // 👉 Balas pesan via email
    public function reply(Request $request, KontakKami $kontak)
    {
        $request->validate([
            'balasan' => 'required|string',
        ]);

        Mail::raw($request->balasan, function ($message) use ($kontak) {
            $message->to($kontak->email)
                ->subject('Balasan dari GBI KJK');
        });

        $kontak->update(['dibalas' => true]);

        return redirect()->route('kontak.index')->with('success', 'Balasan berhasil dikirim.');
    }
}

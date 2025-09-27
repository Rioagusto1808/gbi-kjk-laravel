<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    // Tampilkan semua notifikasi (termasuk yang sudah dibaca)
    public function index(Request $request)
    {
        $user = $request->user();

        // urut terbaru, pagination
        $notifications = $user->notifications()->latest()->paginate(15);

        return view('notifications.index', [
            'notifications' => $notifications,
            'unreadCount'   => $user->unreadNotifications()->count(),
        ]);
    }

    // Tandai semua notifikasi user sebagai sudah dibaca
    public function readAll(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();

        // kalau request dari dropdown modal, balik ke halaman sebelumnya
        return back()->with('success', 'Semua notifikasi ditandai sudah dibaca.');
    }

    // Tandai satu notifikasi sebagai sudah dibaca
    public function read(Request $request, DatabaseNotification $notification)
    {
        // pastikan notifikasi milik user yang login
        if ((int) $notification->notifiable_id !== (int) $request->user()->id) {
            abort(403);
        }

        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        // Bisa return JSON jika dipanggil via AJAX
        if ($request->wantsJson()) {
            return response()->json(['ok' => true]);
        }

        return back()->with('success', 'Notifikasi ditandai sudah dibaca.');
    }
}

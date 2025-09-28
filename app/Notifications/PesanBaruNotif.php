<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PesanBaruNotif extends Notification
{
    use Queueable;

    public $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        // simpan ke database, bukan email
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'nama' => $this->data['nama'],
            'email' => $this->data['email'],
            'pesan' => $this->data['pesan'],
            'time' => now()->toDateTimeString(),
            'url' => route('kontak.show', $this->data['id']),
        ];
    }
}

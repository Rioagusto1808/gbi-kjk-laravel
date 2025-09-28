<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Ibadah;

class IbadahCreatedNotif extends Notification implements ShouldQueue
{
    use Queueable;

    public $ibadah;

    public function __construct(Ibadah $ibadah)
    {
        $this->ibadah = $ibadah;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // email + simpan ke database
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Jadwal Ibadah Baru - GBI KJK')
            ->view('emails.ibadah.created', [ // pakai view custom
                'ibadah' => $this->ibadah,
                'user'   => $notifiable,
            ]);
    }

    public function toDatabase($notifiable)
    {
        return [
            'id'     => $this->ibadah->id,
            'jenis'  => $this->ibadah->jenis,
            'tema'   => $this->ibadah->tema,
            'tanggal'=> $this->ibadah->tanggal_mulai,
            'url'    => route('ibadah.show', $this->ibadah->id),
        ];
    }
}

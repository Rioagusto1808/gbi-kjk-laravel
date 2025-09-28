<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailNotif extends BaseVerifyEmail
{
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verifikasi Email - GBI KJK')
            ->view('emails.auth.verify', [ // ⬅️ custom view
                'url' => $verificationUrl,
                'user' => $notifiable,
            ]);
    }
}

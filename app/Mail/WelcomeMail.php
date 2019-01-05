<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Seja bem vindo.')
            ->markdown('vendor.notifications.email')
            ->with([
                "greeting" => "Olá!",
                "level" => "green",
                "introLines" => [
                    "Esse é um email de boas vindas"
                ],
                "actionText" => "Acesse!",
                "actionUrl" => '/',
                "outroLines" => [
                    'Um abraço,'
                ],
                "salutation" => "**Jonas**"
            ])
            ->from('jonaselan@gmail.com');
    }
}

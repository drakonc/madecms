<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserSendRecover extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $data;

    public function __construct($data)
    {
        $this->dara = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM'),env('APP_NAME'))
                    ->view('pruebaPDF')
                    ->subject('Recuperar su Contraseña');
        /*return $this->from(env('MAIL_FROM'),env('APP_NAME'))
                    ->view('emails.user_password_recover')
                    ->subject('Recuperar su Contraseña')
                    ->with($this->data);*/
    }
}

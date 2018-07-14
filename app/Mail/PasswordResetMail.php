<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    //todo надо эт овсё как то переделать, и сделать через нотификации
    protected $email;
    protected $token;

    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from('notifications@scholarmetrics.com', 'Scholarmetrics')
            ->to($this->email)
            ->subject('ScholarMetrics Password Reset')
            ->view('emails.reset')->with([
                'token' => $this->token
            ]);

        return $mail;
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactsMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from('notifications@scholarmetrics.com', 'Scholarmetrics Notification')
            ->to(env('OWNER_EMAIL'))
            ->subject('ScholarMetrics Contact Form')
            ->view('emails.contacts')->with([
                'subject' => $this->data['subject'],
                'author_email' => $this->data['author_email'],
                'name' => $this->data['name'],
                'author_message' => $this->data['message'],

            ]);

        if (env('COPY_TO_ADMIN') == true){
            $mail->bcc(config('mail')['admin_email']);
        }

        return $mail;
    }
}

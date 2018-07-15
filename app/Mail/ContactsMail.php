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
    protected $type;

    public function __construct($data, $type)
    {
        $this->data = $data;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from('notifications@scholarmetrics.com', 'Scholarmetrics Notification');
        $mail = $mail->to(env('OWNER_EMAIL'));

        if ($this->type == 'contacts'){
            $mail = $mail->subject('ScholarMetrics Contact Form');
            $text = "Somebody left a message on contact page at ".route('contact');
        } else{
            $mail = $mail->subject('ScholarMetrics Report Form');
            $text = "Somebody left a message on metrics page at ".route('metrics');
        }

        $mail = $mail->view('emails.contacts')->with([
                'subject' => $this->data['subject'] ?? '',
                'author_email' => $this->data['author_email'] ?? '',
                'name' => $this->data['name'] ?? '',
                'author_message' => $this->data['message'] ?? '',
                'text' => $text

            ]);

        if (env('COPY_TO_ADMIN') == true){
            $mail = $mail->bcc(config('mail')['admin_email']);
        }

        return $mail;
    }
}

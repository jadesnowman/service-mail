<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailService extends Mailable
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
        // return $this->from('example@sandbox24c0fda85b27477cb8981fe4daec7152.mailgun.org')
        //     ->view('emails.template');
        return $this
            ->from('example@sandbox24c0fda85b27477cb8981fe4daec7152.mailgun.org')
            ->subject('Testing')
            ->view('emails.template');
        // ->with(['data' => $this->data]);
    }
}

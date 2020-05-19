<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $requestEmail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($requestEmail)
    {
        $this->requestEmail = $requestEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('smtp.toannangcantho@gmail.com')
            ->view('themes.child-theme.emails.register')
            ->text('themes.child-theme.emails.register-plain');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordEmail extends Mailable
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
            ->view('themes.child-theme.emails.forgot-password')
            ->text('themes.child-theme.emails.forgot-password-plain');
//            ->attach(public_path('/images').'/demo.jpg', [
//                'as' => 'demo.jpg',
//                'mime' => 'image/jpeg',
//            ]);
    }
}

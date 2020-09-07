<?php 

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPassword extends Mailable {
    use Queueable, SerializesModels;

    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function build()
    {
        return $this->from('no-reply', 'No Reply')
                    ->view('emails.user.forgotPassword')
                    ->with([
                        'uri' => $this->uri
                    ]);
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }


public function build()
{
    $signedUrl = URL::temporarySignedRoute(
        'verification.verify', 
        Carbon::now()->addMinutes(30), // Link 30 minutes tak valid rahega
        ['id' => $this->user->id]
    );

    return $this->subject(__('auth.activate_account'))
        ->view('emails.verify')
        ->with([
            'user' => $this->user, 
            'verificationUrl' => $signedUrl
        ]);
}

}

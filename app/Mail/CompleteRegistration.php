<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompleteRegistration extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $linkVerification;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($props)
    {
        $this->linkVerification = $props['link'];
        $this->name = $props['name'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $firstName = explode(" ", $this->name)[0];
        return $this->view('email.completeRegistration')->with([
            'firstName' => $firstName,
            'link' => $this->linkVerification
        ]);
    }
}

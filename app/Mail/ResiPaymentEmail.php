<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResiPaymentEmail extends Mailable
{

    // Public properties to pass data to the email view
    public $user;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\User $user The user who has an expired payment
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.expired_payment')
                    ->subject('Your Payment Has Expired');
    }
}

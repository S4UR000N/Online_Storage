<?php

// namespace
namespace App\Mail;

// use
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

// class
class ActivationMail extends Mailable {
    // use
    use Queueable, SerializesModels;

    // Properties
    public $activation;

    // Constructor
    public function __construct($user) {
      $this->activation = $user->activation;
    }

    // Message
    public function build() {
      return $this->view('MailView/activation_mail')->with('activation', $this->activation);
    }
}

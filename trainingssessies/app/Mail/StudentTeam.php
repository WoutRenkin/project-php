<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentTeam extends Mailable
{
    use Queueable, SerializesModels;

    public $teamName;
    public $authUser;
    public $receiver;


    public function __construct($teamName, $authUser, $receiver)
    {
        $this->teamName = $teamName;
        $this->authUser = $authUser;
        $this->receiver = $receiver;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("no-reply@trainingssessies.be")->subject("Ingeschreven in team " . $this->teamName)->markdown('emails.studentTeam');
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordReset extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new \App\Mail\ResetPassword($this->token, $this->email));
        //return new (App\Mail\ResetPassword($this->token));
            /*->subject('Notification Subject')
            ->greeting('jooo!')
            ->line('Je hebt deze mail ontvangen omdat er een wachtwoord opnieuw instellen aanvraag is ingediend vcor deze account.') // Here are the lines you can safely override
            ->action('Wachtwoord opnieuw instellen', url('password/reset', $this->token))
            ->line('Als je deze aanvraag niet hebt ingediend moet je niet verder gaan op deze mail.')
            ->salutation('test');*/

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [

        ];
    }
}

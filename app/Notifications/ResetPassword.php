<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        return (new MailMessage)
            ->subject('Réinitialisation de mot de passe - ' . config('app.name'))
            ->line('Vous recevez ce mail car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.')
            ->action('Réinitialiser le mot de passe', url(config('app.url').route('password.reset', $this->token, false)))
            ->line('Si vous n\'avez jamais demandé de réinitialiser votre mot de passe, vous pouvez ignorer cet email.');
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
            //
        ];
    }
}

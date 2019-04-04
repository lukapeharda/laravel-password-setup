<?php

namespace LukaPeharda\LaravelPasswordSetup\Notifications;

use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SetPassword extends Notification
{
    /**
     * @var  string
     */
    public $passwordSetupUrl;

    /**
     * Init notification with link to password setting app/website.
     *
     * @param   string  $passwordSetupUrl
     *
     * @return  void
     */
    public function __construct($passwordSetupUrl)
    {
        $this->passwordSetupUrl = $passwordSetupUrl;
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
            ->subject(Lang::getFromJson('Password Setup Notification'))
            ->line(Lang::getFromJson('You are receiving this email because we created a user account for you and you need to set a password before using it.'))
            ->action(Lang::getFromJson('Set your password'), $this->passwordSetupUrl)
            ->line(Lang::getFromJson('This password setup link will expire in :count minutes.', ['count' => config('auth.passwords.users.expire')]));
    }
}

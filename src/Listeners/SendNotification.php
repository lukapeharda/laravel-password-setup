<?php

namespace LukaPeharda\LaravelPasswordSetup\Listeners;

use Illuminate\Support\Str;

use LukaPeharda\LaravelPasswordSetup\Generators\PasswordToken;
use LukaPeharda\LaravelPasswordSetup\Notifications\SetPassword;

class SendNotification
{
    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle($event)
    {
        // Check whether notification should be sent to users with existing passwords
        if ( ! config('laravel-password-setup.send_to_users_with_existing_password') && ! empty($event->user->password)) {
            return;
        }

        $passwordSetupUrl = (new PasswordToken)->createPasswordSetupUrl($event->user);

        $event->user->notify(new SetPassword($passwordSetupUrl));
    }
}

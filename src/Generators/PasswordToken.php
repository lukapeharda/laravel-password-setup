<?php

namespace LukaPeharda\LaravelPasswordSetup\Generators;

use Illuminate\Support\Facades\Password;
use Illuminate\Contracts\Auth\CanResetPassword;

class PasswordToken
{
    /**
     * Generate token for given user using password broker.
     *
     * @param   \Illuminate\Contracts\Auth\CanResetPassword  $user
     *
     * @return  string
     */
    public function createToken(CanResetPassword $user)
    {
        $broker = Password::broker('users');

        return $broker->createToken($user);
    }
    
    /**
     * Generate password setup link for given user using password broker (or existing token).
     *
     * @param   \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param   string  $token
     *
     * @return  string
     */
    public function createPasswordSetupUrl(CanResetPassword $user, $token = null)
    {
        $token = $token ?? $this->createToken($user);

        $params = [$token];
        
        if (config('laravel-password-setup.user_email_in_url')) {
            $params['email'] = urlencode($user->email);
        }

        $url = url(config('app.url') . route('password.setup', $params, false));

        return $url;
    }
}
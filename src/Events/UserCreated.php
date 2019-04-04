<?php

namespace LukaPeharda\LaravelPasswordSetup\Events;

use Illuminate\Contracts\Auth\CanResetPassword;

class UserCreated
{
    /**
     * @var  \Illuminate\Contracts\Auth\CanResetPassword
     */
    public $user;

    /**
     * User who will receive password setup notification.
     *
     * @param   \Illuminate\Contracts\Auth\CanResetPassword  $user
     *
     * @return  void
     */
    public function __construct(CanResetPassword $user)
    {
        $this->user = $user;
    }
}
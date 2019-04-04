<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Send notification to users whose passwords aren't empty
    |--------------------------------------------------------------------------
    |
    | Supported: true, false
    |
    */
    'send_to_users_with_existing_password' => true,

    /*
    |--------------------------------------------------------------------------
    | Event class
    |--------------------------------------------------------------------------
    |
    | Full qualified name of the event class that will be triggered when you
    | to run a listener for sending notification.
    |
    | Allowed values:
    |  - "\LukaPeharda\LaravelPasswordSetup\Events\UserCreated::class" is
    |    built-in event
    |  - your own custom event (fully qualified name) that has Notifiable $user 
    |    property
    |  - null or false if you wish to disable this and write your own logic
    |
    */
    'event_class' => \LukaPeharda\LaravelPasswordSetup\Events\UserCreated::class,

    /*
    |--------------------------------------------------------------------------
    | Listener class
    |--------------------------------------------------------------------------
    |
    | Full qualified name of the listener class that will used for sending of
    | notification.
    |
    | Allowed values:
    |  - "\LukaPeharda\LaravelPasswordSetup\Listeners\SendNotification::class"
    |    is built-in listener
    |  - your own custom listener (fully qualified name)
    |  - null or false if you wish to disable this and write your own logic
    |
    */
    'listener_class' => \LukaPeharda\LaravelPasswordSetup\Listeners\SendNotification::class,

    /*
    |--------------------------------------------------------------------------
    | Require and validate user email from password setup query string
    |--------------------------------------------------------------------------
    |
    | Wheter to check and validate for existence a user email (for given token)
    | in a password setup query string. In set to false, email field will be
    | presented and need to be filled in.
    |
    | Supported: true, false
    |
    */
    'user_email_in_url' => true,
];
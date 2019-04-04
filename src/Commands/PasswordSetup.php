<?php

namespace LukaPeharda\LaravelPasswordSetup\Commands;

use Illuminate\Console\Command;

use LukaPeharda\LaravelPasswordSetup\Generators\PasswordToken;
use LukaPeharda\LaravelPasswordSetup\Notifications\SetPassword;

class PasswordSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'password:setup {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate password setup token and send it via email to given user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $userModelClass = config('auth.providers.users.model');

        $user = $userModelClass::findOrFail($this->argument('user'));

        $this->info("Found a user: {$user->email}");

        $generator = new PasswordToken;
        $token = $generator->createToken($user);
        $url = $generator->createPasswordSetupUrl($user, $token);
    
        $this->info("Token created: $token");
        $this->info("Setup URL generated: $url");

        $user->notify(new SetPassword($url));

        $this->info("Notification sent");
    }
}
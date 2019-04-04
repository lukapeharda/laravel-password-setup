<?php

namespace LukaPeharda\LaravelPasswordSetup\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

use LukaPeharda\LaravelPasswordSetup\Commands\PasswordSetup;

class PasswordSetupServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'laravel-password-setup');

        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/lukapeharda/laravel-password-setup'),
            __DIR__ . '/../../config/laravel-password-setup.php' => config_path('laravel-password-setup.php'),
        ]);

        $this->bootEvent();

        $this->bootCommands();
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/laravel-password-setup.php', 'laravel-password-setup'
        );
    }

    /**
     * Boot defined event and listener.
     *
     * @return  void
     */
    protected function bootEvent()
    {
        $event = config('laravel-password-setup.event_class');
        $listener = config('laravel-password-setup.listener_class');

        if ( ! empty($event) && ! empty($listener)) {
            Event::listen($event, $listener);
        }
    }

    /**
     * Boot artisan commands.
     *
     * @return  void
     */
    protected function bootCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                PasswordSetup::class,
            ]);
        }
    }
}
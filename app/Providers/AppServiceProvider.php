<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Mail\CustomVerifyEmail;
use Illuminate\Auth\Notifications\VerifyEmail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(VerifyEmail::class, CustomVerifyEmail::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // VerifyEmail::createUrlUsing(function ($notifiable) {
        //     return url("/verify-email/{$notifiable->getKey()}/" . urlencode($notifiable->getEmailForVerification()));
        // });
    }

    
}

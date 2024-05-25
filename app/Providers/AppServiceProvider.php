<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Mail\CustomVerifyEmail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Routing\UrlGenerator;

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
    public function boot(UrlGenerator $url)
    {
        if (env('APP_ENV') == 'production') {
            $url->forceScheme('https');
        }
        // VerifyEmail::createUrlUsing(function ($notifiable) {
        //     return url("/verify-email/{$notifiable->getKey()}/" . urlencode($notifiable->getEmailForVerification()));
        // });
    }


}

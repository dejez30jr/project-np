<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Rate limiter untuk form kontak: maksimal 3 submit per menit per IP
        // (melindungi dari DDoS / brute-force pengiriman pesan)
        RateLimiter::for('contact', function ($job) {
            return Limit::perMinute(3)->by($job->ip());
        });
    }
}

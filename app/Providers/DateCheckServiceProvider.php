<?php

namespace App\Providers;

use App\Services\DateCheck;
use Illuminate\Support\ServiceProvider;

class DateCheckServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('dateCheck', DateCheck::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}

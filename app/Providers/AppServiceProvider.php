<?php

namespace App\Providers;

use App\Contracts\Video\VideoHosting;
use App\Services\Video\Vimeo;
use App\Services\Video\Youtube;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*$serviceVimeo = new Vimeo();
        $this->app->instance(VideoHosting::class, $serviceVimeo);*/
      /*  $this->app->bind(VideoHosting::class, function ($app){
            return new Vimeo();
        });*/
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       // $this->app->bind(Productinterface::class,PostRepository::class);
    }
}

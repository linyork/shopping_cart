<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Service\Promotions\Promotions_2021012600004;
use App\Http\Service\Promotions\Promotions_2021012600001;
use App\Http\Service\Promotions\Promotions_2021012600003;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Promotions_2021012600004::class, function ($app) {
            return new Promotions_2021012600004();
        });
        $this->app->singleton(Promotions_2021012600001::class, function ($app) {
            return new Promotions_2021012600001();
        });
        $this->app->singleton(Promotions_2021012600003::class, function ($app) {
            return new Promotions_2021012600003();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

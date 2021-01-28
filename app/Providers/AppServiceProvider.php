<?php

namespace App\Providers;

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
        foreach (glob(app_path('Http/Service/Promotions/*.php')) as $value)
        {
            $promotion_name = basename($value, ".php");
            $this->app->singleton($promotion_name, function ($app) use ($promotion_name)
            {
                return new $promotion_name();
            });
        }
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

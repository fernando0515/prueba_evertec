<?php

namespace App\Providers;

use App\Services\PlacetopayService;
use App\Services\PseService;
use Illuminate\Foundation\Application;
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
        $this->app->bind(PlacetopayService::class, function (Application $application) {
                return new PlacetopayService(
                    config('placetopay.login'),
                    config('placetopay.secretkey'),
                    config('placetopay.baseurl'),
                );
        });

        $this->app->bind(PseService::class, function (Application $application) {
                return new PseService(
                    config('placetopay.login'),
                    config('placetopay.secretkey'),
                    config('placetopay.baseurl_pse'),
                );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}

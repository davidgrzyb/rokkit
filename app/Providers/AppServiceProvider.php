<?php

namespace App\Providers;

use GuzzleHttp\Client;
use App\Http\Api\CloudwaysApi;
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
        $this->app->bind(CloudwaysApi::class, function ($app) {
            return new CloudwaysApi(
                new Client([
                    'base_uri' => 'https://api.cloudways.com',
                ]),
                config('services.cloudways.client_email'),
                config('services.cloudways.client_key'),
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
        //
    }
}

<?php

namespace Nidhalkratos;

use Nidhalkratos\HttpClient;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class CoconutServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            dirname(__DIR__) . '/config/coconut.php' => config_path('coconut.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton(HttpClient::class, function ($app) {
            $token = config('coconut.token');

            return new HttpClient(
                new Client([
                    'base_uri' => 'https://api.coconut.co/v1/',
                    'auth' => [$token, '']
                ])
            );
        });
    }
}
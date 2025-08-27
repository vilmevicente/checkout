<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PagFanService;

class PagFanServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PagFanService::class, function ($app) {
            return new PagFanService(
                config('services.pagfan.client_id'),
                config('services.pagfan.client_secret'),
                config('services.pagfan.base_url')
            );
        });
    }

    public function boot()
    {
       
    }
}
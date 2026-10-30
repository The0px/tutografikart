<?php

namespace App\Providers;

use App\Weather;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Weather::class, fn ($app): Weather => new Weather($app->make(Repository::class)));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
    }
}

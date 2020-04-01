<?php

namespace App\Providers;

use App\Repository\GifRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\GifRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GifRepositoryInterface::class, GifRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

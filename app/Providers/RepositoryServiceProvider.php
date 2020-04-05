<?php

namespace App\Providers;

use App\Repository\GifRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\ModifiedGifRepository;
use App\Repository\GifRepositoryInterface;
use App\Repository\ModifiedGifRepositoryInterface;

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
        $this->app->bind(ModifiedGifRepositoryInterface::class, ModifiedGifRepository::class);
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

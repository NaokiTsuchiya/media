<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Media\Post\Domain\PostRepositoryInterface;
use Media\Post\Infrastructure\PostRepository;

class PostServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            PostRepositoryInterface::class,
            PostRepository::class
        );
    }
}

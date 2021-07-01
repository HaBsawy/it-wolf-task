<?php

namespace App\Providers;

use App\Repositories\Blogger\BloggerEloquent;
use App\Repositories\Blogger\BloggerInterface;
use App\Repositories\Post\PostEloquent;
use App\Repositories\Post\PostInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    private $repositories = [
        BloggerInterface::class => BloggerEloquent::class,
        PostInterface::class    => PostEloquent::class,
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->repositories as $interface => $eloquent) {
            $this->app->singleton($interface, $eloquent);
        }
    }
}

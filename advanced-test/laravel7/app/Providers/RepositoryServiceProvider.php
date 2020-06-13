<?php

namespace App\Providers;

use App\Repositories\ShirtOrderRepository;
use App\Repositories\ShirtOrderRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(ShirtOrderRepositoryInterface::class, ShirtOrderRepository::class);
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

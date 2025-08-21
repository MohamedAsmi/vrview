<?php

namespace App\Providers;

use App\Repositories\Interfaces\PropertImageRepositoryInterface;
use App\Repositories\Interfaces\PropertRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\PropertyImageRepository;
use App\Repositories\PropertyRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         $this->app->bind(
            UserRepositoryInterface::class, 
            UserRepository::class,
            PropertRepositoryInterface::class, 
            PropertyRepository::class,
            PropertImageRepositoryInterface::class, 
            PropertyImageRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

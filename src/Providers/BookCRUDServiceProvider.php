<?php

namespace VienNguyen113\BookCRUD\Providers;

use Illuminate\Support\ServiceProvider;
use VienNguyen113\BookCRUD\Providers\RouteServiceProvider;
use VienNguyen113\BookCRUD\Services\BookService;
use VienNguyen113\BookCRUD\Services\BookServiceContract;
use VienNguyen113\BookCRUD\Repositories\BookRepository;
use VienNguyen113\BookCRUD\Repositories\BookRepositoryContract;

class BookCRUDServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $package_name = "BookCRUD";

        // routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // view
        $this->loadViewsFrom(__DIR__.'/../resources/views', $package_name);
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/' . $package_name),
        ]);

        // migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        /*
        |--------------------------------------------------------------------------
        | Route Providers need on boot() method, others can be in register() method
        |--------------------------------------------------------------------------
        */
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // Binding
        $this->app->bind(BookRepositoryContract::class, BookRepository::class);
        $this->app->bind(BookServiceContract::class, BookService::class);
    }
}
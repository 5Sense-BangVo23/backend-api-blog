<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\JwtService;
use App\Services\BlgUserService;
use App\Services\BlgAuthorService;
use App\Services\BlgCategoryService;
use App\Services\BlgBookService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind('JwtService', JwtService::class);
        $this->app->bind('BlgUserService', BlgUserService::class);
        $this->app->bind('BlgAuthorService', BlgAuthorService::class);
        $this->app->bind('BlgCategoryService', BlgCategoryService::class);
        $this->app->bind('BlgBookService', BlgBookService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

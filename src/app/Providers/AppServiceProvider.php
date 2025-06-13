<?php

namespace App\Providers;

use App\Interfaces\FileUploadServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\JwtService;
use App\Services\BlgUserService;
use App\Services\BlgAuthorService;
use App\Services\BlgCategoryService;
use App\Services\BlgPublisherService;
use App\Services\BlgBookService;
use App\Services\Upload\CloudinaryUploadService;

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
        $this->app->bind('BlgPublisherService', BlgPublisherService::class);
        $this->app->bind('BlgBookService', BlgBookService::class);

         $this->app->bind(FileUploadServiceInterface::class, CloudinaryUploadService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

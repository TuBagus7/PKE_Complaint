<?php

namespace App\Providers;

use App\Models\Resident;
use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\ResidentRepositoryInterface;
use App\Repositories\AuthRepository;
use App\Repositories\ResidentRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\ReportCategoryRepositoryInterface;
use App\Repositories\ReportCategoryRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            AuthRepositoryInterface::class,
            AuthRepository::class
        );
        $this->app->bind(
            ResidentRepositoryInterface::class,
            ResidentRepository::class
        );

        $this->app->bind(
            ReportCategoryRepositoryInterface::class,
            ReportCategoryRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

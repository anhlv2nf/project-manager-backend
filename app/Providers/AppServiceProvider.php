<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\IUserRepository;
use App\Repositories\UserRepository;
use App\Services\Interfaces\IUserService;
use App\Services\UserService;
use App\Services\Interfaces\IAuthService;
use App\Services\AuthService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind Repositories
        $this->app->bind(IUserRepository::class, UserRepository::class);

        // Bind Services
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IAuthService::class, AuthService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

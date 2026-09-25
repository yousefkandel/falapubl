<?php

namespace App\Providers;

use App\Contracts\Auth\AuthRepositoryInterface;
use App\Contracts\Author\AuthorRepositoryInterface;
use App\Contracts\Book\BookRepositoryInterface;
use App\Contracts\Translator\TranslatorRepositoryInterface;
use App\Contracts\User\UserRepositoryInterface;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Author\AuthorRepository;
use App\Repositories\Book\BookRepository;
use App\Repositories\Translator\TranslatorRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class , AuthRepository::class);
        $this->app->bind(BookRepositoryInterface::class , BookRepository::class);
        $this->app->bind(AuthorRepositoryInterface::class , AuthorRepository::class);
        $this->app->bind(TranslatorRepositoryInterface::class, TranslatorRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            \App\Domain\User\Repositories\UserRepositoryInterface::class,
            \App\Infrastructure\Database\User\EloquentUserRepository::class,
        );
    }
}

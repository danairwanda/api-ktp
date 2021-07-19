<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Register\RegisterRepository;
use App\Repositories\Register\RegisterRepositoryInterface;
use App\Repositories\Temporary\TemporaryRepository;
use App\Repositories\Temporary\TemporaryRepositoryInterface;
use App\Repositories\Identitas\IdentitasRepository;
use App\Repositories\Identitas\IdentitasRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RegisterRepositoryInterface::class, RegisterRepository::class);
        $this->app->bind(TemporaryRepositoryInterface::class, TemporaryRepository::class);
        $this->app->bind(IdentitasRepositoryInterface::class, IdentitasRepository::class);
    }
}

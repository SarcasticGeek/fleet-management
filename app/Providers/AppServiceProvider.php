<?php

namespace App\Providers;

use App\Contracts\BookFacadeInterface;
use App\Contracts\BusRepositoryInterface;
use App\Contracts\CustomerManagerInterface;
use App\Contracts\RouteRepositoryInterface;
use App\Repositories\BusRepository;
use App\Repositories\RouteRepository;
use App\Services\BookFacade;
use App\Services\CustomerManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BookFacadeInterface::class,BookFacade::class);
        $this->app->bind(RouteRepositoryInterface::class, RouteRepository::class);
        $this->app->bind(CustomerManagerInterface::class, CustomerManager::class);
        $this->app->bind(BusRepositoryInterface::class, BusRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

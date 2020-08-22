<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\IRepository\IRepository;
use App\Repositories\IRepository\IModelRepository;
use App\Repositories\ModelRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            IModelRepository::class,
            ModelRepository::class,
            IRepository::class
        );
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

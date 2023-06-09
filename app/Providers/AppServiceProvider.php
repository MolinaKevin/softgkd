<?php

namespace App\Providers;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use InfyOm\RoutesExplorer\Middleware\RoutesExplorerMiddleware;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
		if (!App::environment('testing')) {
        	View::share('roles', Role::all());
		}
        $router = $this->app['router'];
        $router->pushMiddlewareToGroup('api', RoutesExplorerMiddleware::class);
        setlocale(LC_ALL,"es_ES");
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

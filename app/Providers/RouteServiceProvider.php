<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{

    protected $namespace = 'App\Http\Controllers';

    public const HOME = '/home';

    public function boot()
    {
        //

        parent::boot();
    }


    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();


        //
    }



    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }


    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(function($router){
                require base_path('routes/user-api.php');
                require base_path('routes/admin-api.php');
                require base_path('routes/chat-api.php');
            }
        );

    }


}

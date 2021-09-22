<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Interfaces\FrontendRepositoryInterface::class, function(){
            return new \App\Repositories\FrontendRepository;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('frontend.*', function($view){
            $view->with('defaultPhoto', asset('images/defaultPhoto.png'));
        });
    }
}

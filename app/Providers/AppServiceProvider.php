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

        $this->app->bind(\App\Interfaces\UserRepositoryInterface::class, function(){
            return new \App\Repositories\UserRepository;
        });

        $this->app->bind(\App\Interfaces\BusinessRepositoryInterface::class, function(){
            return new \App\Repositories\BusinessRepository;
        });

        $this->app->bind(\App\Interfaces\BackendRepositoryInterface::class, function(){
            return new \App\Repositories\BackendRepository;
        });

        $this->app->bind(\App\Interfaces\ServiceRepositoryInterface::class, function(){
            return new \App\Repositories\ServiceRepository;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('event.*', '\App\ViewComposers\UserComposer');
        View::composer('layouts.app', '\App\ViewComposers\AppComposer');

        View::composer('frontend.*', function($view){
            $view->with('defaultPhoto', asset('images/defaultPhoto.png'));
        });

        View::composer('business.*', function($view){
            $view->with('defaultPhoto', asset('images/defaultPhoto.png'));
        });

        View::composer('event.*', function($view){
            $view->with('defaultPhoto', asset('images/defaultPhoto.png'));
        });
    }
}

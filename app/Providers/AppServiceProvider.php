<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.partials.navigation', function($view){
            $view->with('navMenus', DB::select("select * from cms_menu where type = 'nav'"));
        });
        view()->composer('layouts.partials.footer', function($view){
            $view->with('footerMenus', DB::select("select * from cms_menu where type = 'footer'"));
        });
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

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //pagiantion problem
        // pagiantion::bootstrap();

        //setting
        $setting=DB::table('settings')->first();
        view()->share('setting',$setting);
    }
}

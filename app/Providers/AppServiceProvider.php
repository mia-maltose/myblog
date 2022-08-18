<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use App\Models\User;



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
        Gate::define('admin', function(User $user) {
            return $user->username == 'Mia Fang' || $user->username == 'Mia F' || $user->username == 'malt';
            // if the user automatically passed into the function has a username of
            // 'Mia Fang','Mia F' or 'malt', the user is an 'admin'
        });

        Blade::if('admin',function() {
            return request()->user()?->can('admin'); // returns boolean
        });
    }
}

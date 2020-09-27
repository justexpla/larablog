<?php

namespace App\Providers;

use App\Models\Commentary;
use App\Models\User;
use App\Observers\CommentaryObserver;
use App\Observers\UserObserver;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);         #TODO: Просмотреть, можно ли переписать на EventServiceProvider
        Commentary::observe(CommentaryObserver::class);
    }
}

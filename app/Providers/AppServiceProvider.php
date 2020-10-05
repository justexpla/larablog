<?php

namespace App\Providers;

use App\Models\BlackList;
use App\Models\Commentary;
use App\Models\User;
use App\Observers\BlackListObserver;
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
        User::observe(UserObserver::class);         #Просмотреть, можно ли переписать на EventServiceProvider (можно, через метод handle)
        Commentary::observe(CommentaryObserver::class);
        BlackList::observe(BlackListObserver::class);
    }
}

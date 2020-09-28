<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function (User $user) {
            if ($user->id === 1) {
                return true;
            }
        });

        Gate::define('create_post', function (User $user) {
            return ! $user->isBanned();
        });

        Gate::define('edit_post', function (User $user, Post $post) {
            if ($user->isModerator()) {
                return ! $post->user->isAdmin();        #запрет модерам влиять на посты админа
            }
            return $post->user_id === $user->id;
        });

        Gate::define('edit_profile', function (User $authUser, User $requiredUser){
            return $authUser->id === $requiredUser->id;
        });

        Gate::define('create_comments', function (User $user) {
            return ! $user->isBanned();
        });
    }
}

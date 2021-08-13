<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\PostPolicy;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::resource('post', PostPolicy::class);
        Gate::define('post.publish', PostPolicy::class . '@publish');
        Gate::define('post.draft', PostPolicy::class . '@draft');
        //https://www.youtube.com/watch?v=vbfpxi9SDvw&list=PL3V6a6RU5ogHVV4rI49IRVXoHXiWVQoAk
        Gate::define('is_admin', function($user){
            return $user->isSuperAdmin();
            });

        Gate::define('user.update', function ($user) {
            return $user->isSuperAdmin() || $user->hasAccess(['user.update']);
        });

        Gate::define('user.view', function ($user) {
            return $user->isSuperAdmin() || $user->hasAccess(['user.view']);
        });

        Gate::define('role.view', function ($user) {
            return $user->isSuperAdmin() || $user->hasAccess(['role.view']);
        });

        Gate::define('role.update', function ($user) {
            return $user->isSuperAdmin() || $user->hasAccess(['role.update']);
        });

        Gate::define('role.create', function ($user) {
            return $user->isSuperAdmin();
        });

        Gate::define('role.delete', function ($user) {
            return $user->isSuperAdmin();
        });

        Gate::define('role.update-user', function ($user) {
            return $user->isSuperAdmin() || $user->hasAccess(['role.update-user']);
        });
    }
}
<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update_delete', function ($user, $validate) {
            if ($user->id == $validate->user_id) {
                return true;
            }
            return false;
        });

        Gate::define('see-post', function ($user, $post) {
            if ($user->id == $post->user_id) {
                return true;
            }
            return false;
        });
    }
}

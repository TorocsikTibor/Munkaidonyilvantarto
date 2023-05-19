<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\UserHasRole;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {

        $this->registerPolicies();

        Gate::before( function ($user, $ability) {

            $admin = UserHasRole::where('user_id', $user->id)->with('role')->get();
            foreach ($admin as $admins)
            {
                if ($admins->role->name === 'admin') {
                    return true;
                }
            }
        });


        Gate::define('manager', function (User $user) {
            $users = UserHasRole::where('user_id', $user->id)->with('role')->get();

            foreach ($users as $user)
            {
                if ($user->role->name === 'manager') {
                    return true;
                }
            }
        });

        Gate::define('user', function (User $user) {
            $users = UserHasRole::where('user_id', $user->id)->with('role')->get();

            foreach ($users as $user)
            {
                if ($user->role->name === 'user') {
                    return true;
                }
            }
        });
    }
}

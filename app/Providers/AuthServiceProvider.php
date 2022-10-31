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
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */

//    public static $permissions = [
//        'index-product' => ['manager', 'customer'],
//        'show-product' => ['manager', 'customer'],
//        'create-product' => ['manager'],
//        'store-product' => ['manager'],
//        'edit-product' => ['manager'],
//        'update-product' => ['manager'],
//        'destroy-product' => ['manager'],
//    ];


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
            $admin = UserHasRole::where('user_id', $user->id)->with('role')->get();

            foreach ($admin as $admins)
            {
                if ($admins->role->name === 'manager') {
                    return true;
                }
            }
        });

        Gate::define('user', function (User $user) {
            $admin = UserHasRole::where('user_id', $user->id)->with('role')->get();

            foreach ($admin as $admins)
            {
                if ($admins->role->name === 'user') {
                    return true;
                }
            }
        });


    }
}

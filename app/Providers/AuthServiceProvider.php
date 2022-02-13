<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot(): void
    {
        $this->registerPolicies();
//        Gate::define("view-dashboard", static function (User $user) {
//            return $user->role->hasPermission('view-dashboard');
//        });
//        Gate::define("create-role", static function (User $user) {
//            return $user->role->hasPermission('create-role');
//        });
        // for set all permission in site ===================================================================
        foreach ($this->getPermissions() as $permission) {
            Gate::define($permission->title, static function (User $user) use ($permission) {
                return $user->role->hasPermission($permission->title);
            });
        }
    }

    // for get all permission in site ===================================================================
    public function getPermissions(): Collection|array
    {
        return Permission::with('roles')->get();
    }

}

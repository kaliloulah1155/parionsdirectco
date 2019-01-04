<?php

namespace App\Providers;

use App\Models\Permission;
use App\Policies\PermissionPolicy;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Permission::class => PermissionPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
     public function boot()
    {
       $this->registerPolicies();

    }
    /*  public function boot(GateContract $gate)
    {
       $this->registerPolicies( $gate);

      foreach ($this->getPermissions() as $permission){
            $gate->define($permission->libelle,function($user) use ($permission) {
                return $user->hasProfile($permission->profils);
            });
        }
    }*/
   /*protected function getPermissions(){
        return Permission::with('profils')->get();
    }*/
}

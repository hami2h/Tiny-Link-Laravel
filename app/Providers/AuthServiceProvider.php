<?php

namespace App\Providers;

use App\Models\Link;
use App\Models\User;
use App\Policies\LinkPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

        Link::class => LinkPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        Gate::before(function (User $user, $actions, $params) {
            if ($user->type == 'admin') {
                if (isset($params[0]) && $params[0] instanceof Link) {
                    switch ($actions) {
                        case 'remove':
                        case 'changeState':
                        case 'edit':
                            return true;
                    }
                }
            }
        });

        $this->registerPolicies();
    }
}

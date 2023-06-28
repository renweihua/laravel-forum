<?php

namespace App\Modules\Forum\Providers;

use App\Modules\Forum\Entities\Dynamic;
use App\Modules\Forum\Policies\DynamicPolicy;
use App\Modules\User\Entities\UserAuth;
use App\Modules\User\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Dynamic::class => DynamicPolicy::class,
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
}

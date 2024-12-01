<?php

namespace App\Providers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Gate as Gate2;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Order;
use App\Policies\OrderPolicy;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Order::class => OrderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate2::define(
            'my-comment',
            function (User $user, Review $review) {
                return $user->id == $review->user_id;
            }
        );

        $this->registerPolicies();
        app(Gate::class)->before(function (Authorizable $authorizable, $route) {
            if (method_exists($authorizable, 'hasPermission')) {
                return $authorizable->hasPermission($route) ? $authorizable->hasPermission($route) : false;
            }
            return false;
        });
    }
}

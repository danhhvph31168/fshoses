<?php

namespace App\Providers;

use App\Events\OrderCanceled;
use App\Events\RefundCreate;
use App\Listeners\SendRefundNotification;
use App\Events\OrderCreateClient;
use App\Events\OrderDelivered;
use App\Listeners\SendOrderCanceled;
use App\Listeners\SendOrderClientEmail;
use App\Listeners\SendOrderDelivered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        RefundCreate::class => [
            SendRefundNotification::class
        ],
        OrderCreateClient::class => [
            SendOrderClientEmail::class,
        ],
        OrderCanceled::class => [
            SendOrderCanceled::class,
        ],
        OrderDelivered::class => [
            SendOrderDelivered::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

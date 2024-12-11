<?php

namespace App\Listeners;

use App\Events\OrderCanceled;
use App\Events\OrderDelivered;
use App\Notifications\AddOrderClient;
use App\Notifications\OrderCanceledNotify;
use App\Notifications\OrderDeliveredNotify;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderDelivered
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderDelivered $event): void
    {
        $user = $event->order->user;
        $user->notify(new OrderDeliveredNotify($event->order));
    }
}

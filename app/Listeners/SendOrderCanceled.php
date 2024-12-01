<?php

namespace App\Listeners;

use App\Events\OrderCanceled;
use App\Notifications\AddOrderClient;
use App\Notifications\OrderCanceledNotify;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderCanceled
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
    public function handle(OrderCanceled $event): void
    {
        $user = $event->order->user;
        $user->notify(new OrderCanceledNotify($event->order));
    }
}

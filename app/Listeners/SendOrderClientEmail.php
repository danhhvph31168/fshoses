<?php

namespace App\Listeners;

use App\Events\OrderCreateClient;
use App\Notifications\AddOrderClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderClientEmail
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
    public function handle(OrderCreateClient $event): void
    {
        $user = $event->order->user;
        $user->notify(new AddOrderClient($event->order));
    }
}

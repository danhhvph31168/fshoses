<?php

namespace App\Listeners;

use App\Events\RefundCreate;
use App\Notifications\AddRefund;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendRefundNotification
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
    public function handle(RefundCreate $event): void
    {
        $user = $event->refund->user;
        $user->notify(new AddRefund($event->refund));
    }
}

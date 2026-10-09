<?php

namespace App\Listeners;

use App\Events\OrderCreated;

class AfterOrderCreated
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
    public function handle(OrderCreated $event): void
    {
        $order = $event->getOrder();

    }
}

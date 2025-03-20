<?php

namespace Modules\Orders\src\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ShippingPaid
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public object $order,
    )
    {
    }
}

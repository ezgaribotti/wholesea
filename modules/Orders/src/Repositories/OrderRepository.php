<?php

namespace Modules\Orders\src\Repositories;

use App\Repositories\Repository;
use Modules\Orders\src\Entities\Order;
use Modules\Orders\src\Interfaces\OrderRepositoryInterface;

class OrderRepository extends Repository implements OrderRepositoryInterface
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }
}

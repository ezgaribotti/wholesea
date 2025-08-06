<?php

namespace Modules\Shipments\src\Interfaces;

use App\Interfaces\RepositoryInterface;

interface ShipmentRepositoryInterface extends RepositoryInterface
{
    public function existsByOrderId(int $orderId): bool;
}

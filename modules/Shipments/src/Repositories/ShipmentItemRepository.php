<?php

namespace Modules\Shipments\src\Repositories;

use App\Repositories\Repository;
use Modules\Shipments\src\Entities\ShipmentItem;
use Modules\Shipments\src\Interfaces\ShipmentItemRepositoryInterface;

class ShipmentItemRepository extends Repository implements ShipmentItemRepositoryInterface
{
    public function __construct(ShipmentItem $item)
    {
        parent::__construct($item);
    }
}

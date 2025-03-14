<?php

namespace Modules\Shipments\src\Repositories;

use App\Repositories\Repository;
use Modules\Shipments\src\Entities\Shipment;
use Modules\Shipments\src\Interfaces\ShipmentRepositoryInterface;

class ShipmentRepository extends Repository implements ShipmentRepositoryInterface
{
    public function __construct(Shipment $shipment)
    {
        parent::__construct($shipment);
    }
}

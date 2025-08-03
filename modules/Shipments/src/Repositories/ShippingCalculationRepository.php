<?php

namespace Modules\Shipments\src\Repositories;

use App\Repositories\Repository;
use Modules\Shipments\src\Entities\ShippingCalculation;
use Modules\Shipments\src\Interfaces\ShippingCalculationRepositoryInterface;

class ShippingCalculationRepository extends Repository implements ShippingCalculationRepositoryInterface
{
    public function __construct(ShippingCalculation $calculation)
    {
        parent::__construct($calculation);
    }
}

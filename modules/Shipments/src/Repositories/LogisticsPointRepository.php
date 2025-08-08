<?php

namespace Modules\Shipments\src\Repositories;

use App\Repositories\Repository;
use Modules\Shipments\src\Entities\LogisticsPoint;
use Modules\Shipments\src\Interfaces\LogisticsPointRepositoryInterface;

class LogisticsPointRepository extends Repository implements LogisticsPointRepositoryInterface
{
    public function __construct(LogisticsPoint $logisticsPoint)
    {
        parent::__construct($logisticsPoint);
    }
}

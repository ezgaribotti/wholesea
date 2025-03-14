<?php

namespace Modules\Shipments\src\Repositories;

use App\Repositories\Repository;
use Modules\Shipments\src\Entities\Tracking;
use Modules\Shipments\src\Interfaces\TrackingRepositoryInterface;

class TrackingRepository extends Repository implements TrackingRepositoryInterface
{
    public function __construct(Tracking $tracking)
    {
        parent::__construct($tracking);
    }
}

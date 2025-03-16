<?php

namespace Modules\Shipments\src\Repositories;

use App\Repositories\Repository;
use Modules\Shipments\src\Entities\TrackingStatus;
use Modules\Shipments\src\Interfaces\TrackingStatusRepositoryInterface;

class TrackingStatusRepository extends Repository implements TrackingStatusRepositoryInterface
{
    public function __construct(TrackingStatus $status)
    {
        parent::__construct($status);
    }

    public function findByName(string $name): object
    {
        return $this->entity->whereName($name)->firstOrFail();
    }
}

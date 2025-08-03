<?php

namespace Modules\Shipments\src\Repositories;

use App\Repositories\Repository;
use Modules\Shipments\src\Entities\TransportType;
use Modules\Shipments\src\Interfaces\TransportTypeRepositoryInterface;

class TransportTypeRepository extends Repository implements TransportTypeRepositoryInterface
{
    public function __construct(TransportType $type)
    {
        parent::__construct($type);
    }
}

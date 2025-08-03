<?php

namespace Modules\Shipments\src\Repositories;

use App\Repositories\Repository;
use Modules\Shipments\src\Entities\CargoManifest;
use Modules\Shipments\src\Interfaces\CargoManifestRepositoryInterface;

class CargoManifestRepository extends Repository implements CargoManifestRepositoryInterface
{
    public function __construct(CargoManifest $manifest)
    {
        parent::__construct($manifest);
    }
}

<?php

namespace Modules\Shipments\src\Interfaces;

use App\Interfaces\RepositoryInterface;

interface TrackingStatusRepositoryInterface extends RepositoryInterface
{
    public function findByName(string $name): object;
}

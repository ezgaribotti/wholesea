<?php

namespace Modules\Shipments\src\Interfaces;

use App\Interfaces\RepositoryInterface;

interface LogisticsPointRepositoryInterface extends RepositoryInterface
{
    public function findByCountryId(int $countryId): ?object;
}

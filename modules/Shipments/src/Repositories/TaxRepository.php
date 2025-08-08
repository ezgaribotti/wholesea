<?php

namespace Modules\Shipments\src\Repositories;

use App\Repositories\Repository;
use Modules\Shipments\src\Entities\Tax;
use Modules\Shipments\src\Interfaces\TaxRepositoryInterface;

class TaxRepository extends Repository implements TaxRepositoryInterface
{
    public function __construct(Tax $tax)
    {
        parent::__construct($tax);
    }
}

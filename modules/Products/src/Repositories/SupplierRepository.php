<?php

namespace Modules\Products\src\Repositories;

use App\Repositories\Repository;
use Modules\Products\src\Entities\Supplier;
use Modules\Products\src\Interfaces\SupplierRepositoryInterface;

class SupplierRepository extends Repository implements SupplierRepositoryInterface
{
    public function __construct(Supplier $supplier)
    {
        parent::__construct($supplier);
    }
}

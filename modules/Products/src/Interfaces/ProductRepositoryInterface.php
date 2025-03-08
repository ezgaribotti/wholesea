<?php

namespace Modules\Products\src\Interfaces;

use App\Interfaces\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function findBySku(string $sku): ?object;
}

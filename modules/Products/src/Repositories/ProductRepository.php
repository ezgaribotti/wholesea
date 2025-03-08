<?php

namespace Modules\Products\src\Repositories;

use App\Repositories\Repository;
use Modules\Products\src\Entities\Product;
use Modules\Products\src\Interfaces\ProductRepositoryInterface;

class ProductRepository extends Repository implements ProductRepositoryInterface
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function findBySku(string $sku): ?object
    {
        return $this->entity->whereSku($sku)->first();
    }
}

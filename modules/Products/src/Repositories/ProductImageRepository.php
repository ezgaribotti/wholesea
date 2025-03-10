<?php

namespace Modules\Products\src\Repositories;

use App\Repositories\Repository;
use Modules\Products\src\Entities\ProductImage;
use Modules\Products\src\Interfaces\ProductImageRepositoryInterface;

class ProductImageRepository extends Repository implements ProductImageRepositoryInterface
{
    public function __construct(ProductImage $image)
    {
        parent::__construct($image);
    }
}

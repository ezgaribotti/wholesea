<?php

namespace Modules\Products\src\Repositories;

use App\Repositories\Repository;
use Modules\Products\src\Entities\Category;
use Modules\Products\src\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends Repository implements CategoryRepositoryInterface
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }
}

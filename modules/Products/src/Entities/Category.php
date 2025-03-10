<?php

namespace Modules\Products\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Products\database\Factories\CategoryFactory;

class Category extends Entity
{
    use HasFactory;

    protected static function newFactory(): object
    {
        return CategoryFactory::new();
    }
}

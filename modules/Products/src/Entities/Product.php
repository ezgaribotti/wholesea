<?php

namespace Modules\Products\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Products\database\Factories\ProductFactory;

class Product extends Entity
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'sku',
        'active',
        'stock',
        'unit_price',
        'category_id',
        'description',
    ];

    public function category(): object
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): object
    {
        return $this->hasMany(ProductImage::class);
    }

    protected static function newFactory(): object
    {
        return ProductFactory::new();
    }
}

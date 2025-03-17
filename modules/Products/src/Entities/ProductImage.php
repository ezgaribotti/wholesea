<?php

namespace Modules\Products\src\Entities;

use App\Entities\NoTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Products\database\Factories\ProductImageFactory;

class ProductImage extends NoTimestamp
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'path',
        'full_url',
        'description',
    ];

    protected static function newFactory(): object
    {
        return ProductImageFactory::new();
    }
}

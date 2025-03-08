<?php

namespace Modules\Products\src\Entities;

use App\Entities\Entity;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Products\database\Factories\ProductFactory;

class Product extends Entity
{
    use HasFactory;

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

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope());
    }

    protected static function newFactory(): object
    {
        return ProductFactory::new();
    }
}

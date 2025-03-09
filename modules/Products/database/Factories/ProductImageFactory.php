<?php

namespace Modules\Products\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Products\src\Entities\Product;
use Modules\Products\src\Entities\ProductImage;

class ProductImageFactory extends Factory
{
    protected $model = ProductImage::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'full_url' => fake()->url(),
            'description' => fake()->title(),
        ];
    }
}

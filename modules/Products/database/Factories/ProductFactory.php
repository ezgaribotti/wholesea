<?php

namespace Modules\Products\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Products\src\Entities\Category;
use Modules\Products\src\Entities\Product;
use Modules\Products\src\Entities\Supplier;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'sku' => fake()->unique()->unixTime(),
            'unit_price' => fake()->randomDecimal(),
            'weight' => fake()->randomDecimal(),
            'stock' => fake()->randomNumber(),
            'category_id' => Category::factory(),
            'supplier_id' => Supplier::first(),
            'description' => fake()->text(),
        ];
    }
}

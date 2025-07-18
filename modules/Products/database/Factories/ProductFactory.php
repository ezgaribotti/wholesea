<?php

namespace Modules\Products\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Products\src\Entities\Category;
use Modules\Products\src\Entities\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => fake()->title(),
            'sku' => fake()->unique()->unixTime(),
            'unit_price' => fake()->randomFloat(2, 10, 100),
            'stock' => fake()->randomNumber(),
            'category_id' => Category::factory(),
            'description' => fake()->text(),
        ];
    }
}

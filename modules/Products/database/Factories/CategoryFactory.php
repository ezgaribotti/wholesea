<?php

namespace Modules\Products\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Products\src\Entities\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => fake()->word()
        ];
    }
}

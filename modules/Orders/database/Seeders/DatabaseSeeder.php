<?php

namespace Modules\Orders\database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\src\Entities\Product;
use Modules\Orders\src\Entities\Order;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        (Order::factory()->create())->products()->attach(Product::factory()->create()->id, [
            'quantity' => 1,
            'fixed_price' => fake()->randomDecimal(),
        ]);
    }
}

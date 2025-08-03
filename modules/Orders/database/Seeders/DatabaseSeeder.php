<?php

namespace Modules\Orders\database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Orders\src\Entities\Order;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Order::factory()->create();
    }
}

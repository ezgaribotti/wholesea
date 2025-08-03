<?php

namespace Modules\Common\database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Common\src\Entities\Country;
use Modules\Common\src\Entities\CustomerAddress;
use Modules\Common\src\Entities\Operator;
use Modules\Common\src\Entities\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $internalCode = config('app.env');

        Operator::whereInternalCode($internalCode)->firstOr(function () use ($internalCode) {
            return Operator::factory()->create([
                'internal_code' => $internalCode,
                'password' => Hash::make('password'),
            ]);
        });
        Country::factory()->create();
        CustomerAddress::factory()->create();
        Product::factory()->create();
    }
}

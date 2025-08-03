<?php

namespace Modules\Common\database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Common\src\Entities\Operator;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $internalCode = 'admin';

        Operator::firstOrCreate(['internal_code' => $internalCode], Operator::factory()->make([
            'internal_code' => $internalCode,
            'password' => Hash::make('password'),
        ])->toArray());
    }
}

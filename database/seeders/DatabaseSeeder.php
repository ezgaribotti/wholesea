<?php

namespace Database\Seeders;

use App\Providers\ModuleServiceProvider;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ModuleServiceProvider::seedersToRun());
    }
}

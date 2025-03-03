<?php

namespace Modules\Operators\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Operators\src\Entities\Operator;

class OperatorFactory extends Factory
{
    protected $model = Operator::class;

    public function definition(): array
    {
        return [];
    }
}

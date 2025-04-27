<?php

namespace Modules\Auth\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\src\Entities\Link;

class LinkFactory extends Factory
{
    protected $model = Link::class;

    public function definition(): array
    {
        return [];
    }
}

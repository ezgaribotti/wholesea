<?php

namespace Modules\Auth\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\src\Entities\MenuLink;

class MenuLinkFactory extends Factory
{
    protected $model = MenuLink::class;

    public function definition(): array
    {
        return [];
    }
}

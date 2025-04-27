<?php

namespace Modules\Auth\src\Interfaces;

use App\Interfaces\RepositoryInterface;

interface LinkRepositoryInterface extends RepositoryInterface
{
    public function getBySlugs(array $slugs): object;
}

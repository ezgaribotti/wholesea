<?php

namespace Modules\Auth\src\Interfaces;

use App\Interfaces\RepositoryInterface;

interface MenuLinkRepositoryInterface extends RepositoryInterface
{
    public function getBySlugs(array $slugs): object;
}

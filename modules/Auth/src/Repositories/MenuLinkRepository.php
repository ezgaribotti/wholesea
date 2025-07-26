<?php

namespace Modules\Auth\src\Repositories;

use App\Repositories\Repository;
use Modules\Auth\src\Entities\MenuLink;
use Modules\Auth\src\Interfaces\MenuLinkRepositoryInterface;

class MenuLinkRepository extends Repository implements MenuLinkRepositoryInterface
{
    public function __construct(MenuLink $link)
    {
        parent::__construct($link);
    }

    public function getBySlugs(array $slugs): object
    {
        return $this->entity->whereIn('slug', $slugs)->get();
    }
}

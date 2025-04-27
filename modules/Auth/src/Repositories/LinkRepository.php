<?php

namespace Modules\Auth\src\Repositories;

use App\Repositories\Repository;
use Modules\Auth\src\Entities\Link;
use Modules\Auth\src\Interfaces\LinkRepositoryInterface;

class LinkRepository extends Repository implements LinkRepositoryInterface
{
    public function __construct(Link $link)
    {
        parent::__construct($link);
    }

    public function getBySlugs(array $slugs): object
    {
        return $this->entity->whereIn('slug', $slugs)->get();
    }
}

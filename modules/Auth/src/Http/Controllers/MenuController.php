<?php

namespace Modules\Auth\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Auth\src\Http\Resources\MenuLinkResource;
use Modules\Auth\src\Interfaces\MenuLinkRepositoryInterface;

class MenuController extends Controller
{
    public function __construct(
        protected MenuLinkRepositoryInterface $linkRepository,
    )
    {
    }

    public function index(): object
    {
        $slugs = [];
        auth()->user()->permissions->each(function (object $permission) use (&$slugs) {
            $slugs[] = $permission->slug;
        });
        $links = $this->linkRepository->getBySlugs($slugs);
        return response()->success(MenuLinkResource::collection($links));
    }
}

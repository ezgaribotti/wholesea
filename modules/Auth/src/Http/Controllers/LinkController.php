<?php

namespace Modules\Auth\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Auth\src\Http\Resources\LinkResource;
use Modules\Auth\src\Interfaces\LinkRepositoryInterface;

class LinkController extends Controller
{
    public function __construct(
        protected LinkRepositoryInterface $linkRepository,
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
        return response()->success(LinkResource::collection($links));
    }
}

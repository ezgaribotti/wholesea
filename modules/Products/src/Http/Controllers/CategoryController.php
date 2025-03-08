<?php

namespace Modules\Products\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Products\src\Http\Resources\CategoryResource;
use Modules\Products\src\Interfaces\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository,
    )
    {
    }

    public function index(): object
    {
        $categories = $this->categoryRepository->all();
        return response()->success(CategoryResource::collection($categories));
    }
}

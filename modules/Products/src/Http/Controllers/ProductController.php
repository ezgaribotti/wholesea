<?php

namespace Modules\Products\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Products\src\Http\Requests\StoreProductRequest;
use Modules\Products\src\Http\Requests\UpdateProductRequest;
use Modules\Products\src\Http\Resources\ProductResource;
use Modules\Products\src\Http\Resources\ProductSummaryResource;
use Modules\Products\src\Interfaces\ProductRepositoryInterface;

class ProductController extends Controller
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
    )
    {
    }

    public function index(Request $request): object
    {
        $products = $this->productRepository->paginate($request->filters);
        return response()->withPaginate(ProductSummaryResource::collection($products));
    }

    public function store(StoreProductRequest $request): object
    {
        $this->productRepository->create($request->validated());
        return response()->justMessage('Product successfully created.');
    }

    public function show(string $id): object
    {
        $product = $this->productRepository->find($id);
        if (!$product) {
            abort(404, 'Product not found.');
        }
        return response()->success(new ProductResource($product));
    }

    public function update(UpdateProductRequest $request, string $id): object
    {
        $product = $this->productRepository->findOrFail($id);

        if ($product->sku != $request->sku) {
            if ($this->productRepository->findBySku($request->sku)) {
                abort(422, 'Sku already exists.');
            }
        }

        $this->productRepository->update($request->validated(), $id);
        return response()->justMessage('Product successfully updated.');
    }

    public function destroy(string $id): object
    {
        $this->productRepository->delete($id);
        return response()->justMessage('Product successfully deleted.');
    }
}

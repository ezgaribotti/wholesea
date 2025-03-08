<?php

namespace Modules\Products\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Products\src\Http\Requests\UploadProductImageRequest;
use Modules\Products\src\Interfaces\ProductImageRepositoryInterface;

class ProductImageController extends Controller
{
    public function __construct(
        protected ProductImageRepositoryInterface $imageRepository,
    )
    {
    }

    public function upload(UploadProductImageRequest $request): object
    {
        return response()->justMessage('Image successfully uploaded.');
    }
}

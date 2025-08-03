<?php

namespace Modules\Shipments\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Shipments\src\Http\Resources\CargoManifestResource;
use Modules\Shipments\src\Interfaces\CargoManifestRepositoryInterface;

class CargoManifestController extends Controller
{
    public function __construct(
        protected CargoManifestRepositoryInterface $cargoManifestRepository,
    )
    {
    }

    public function index(): object
    {
        $manifests = $this->cargoManifestRepository->all();
        return response()->success(CargoManifestResource::collection($manifests));
    }
}

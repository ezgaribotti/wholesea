<?php

namespace Modules\Shipments\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Shipments\src\Http\Resources\TransportTypeResource;
use Modules\Shipments\src\Interfaces\TransportTypeRepositoryInterface;

class TransportTypeController extends Controller
{
    public function __construct(
        protected TransportTypeRepositoryInterface $transportTypeRepository,
    )
    {
    }

    public function index(): object
    {
        $types = $this->transportTypeRepository->all();
        return response()->success(TransportTypeResource::collection($types));
    }
}

<?php

namespace Modules\Shipments\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Shipments\src\Http\Requests\CalculateShippingCostRequest;
use Modules\Shipments\src\Http\Resources\ShippingCostResource;
use Modules\Shipments\src\Interfaces\ShippingCalculationRepositoryInterface;

class ShippingCostController extends Controller
{
    public function __construct(
        protected ShippingCalculationRepositoryInterface $shippingCalculationRepository,
    )
    {
    }

    public function calculate(CalculateShippingCostRequest $request): object
    {
        $cost = 2000;

        $calculation = $this->shippingCalculationRepository->create([
            'tracking_code' => $request->tracking_code,
            'cost' => $cost,
        ]);

        return response()->success(new ShippingCostResource($calculation));
    }
}

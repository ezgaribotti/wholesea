<?php

namespace Modules\Shipments\src\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentSummaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tracking_code' => $this->tracking_code,
            'payment_status' => $this->payment?->status,
            'tracking_status_name' => $this->trackingStatus->name,
        ];
    }
}

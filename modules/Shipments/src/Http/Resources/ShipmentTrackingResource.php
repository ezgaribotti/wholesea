<?php

namespace Modules\Shipments\src\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentTrackingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'tracking_status_name' => $this->trackingStatus->name,
            'created_at' => $this->created_at,
        ];
    }
}

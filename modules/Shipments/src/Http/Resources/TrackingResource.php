<?php

namespace Modules\Shipments\src\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrackingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'status_name' => $this->trackingStatus->name,
            'created_at' => $this->created_at,
        ];
    }
}

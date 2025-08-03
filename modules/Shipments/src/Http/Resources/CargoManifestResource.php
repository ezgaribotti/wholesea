<?php

namespace Modules\Shipments\src\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CargoManifestResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'transport_code' => $this->transport_code,
            'transport_type' => new TransportTypeResource($this->transportType),
            'status' => $this->status,
            'coordinates' => json_decode($this->coordinates, true),
            'current_weight' => $this->current_weight,
            'max_weight' => $this->max_weight,
            'extra_handling_fee' => $this->extra_handling_fee,
            'final_cost' => $this->final_cost,
            'departure_at' => $this->departure_at,
            'arrival_at' => $this->arrival_at,
        ];
    }
}

<?php

namespace Modules\Orders\src\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tracking_number' => $this->tracking_number,
            'payment' => new PaymentResource($this->payment),
            'customer' => new CustomerResource($this->customerAddress->customer),
            'customer_address' => new CustomerAddressResource($this->customerAddress),
            'items' => ItemResource::collection($this->products),
            'total_amount' => $this->total_amount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

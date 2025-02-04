<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'status' => $this->status,
            'identity_document_type' => IdentityDocumentTypeResource::make($this->identityDocumentType),
            'identity_document' => $this->identity_document,
            'email' => $this->email,
            'phone' => $this->phone,
            'addresses' => CustomerAddressResource::collection($this->addresses),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

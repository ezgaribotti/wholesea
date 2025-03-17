<?php

namespace Modules\Shipments\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_address_id' => 'required|exists:customer_addresses,id',
            'items' => 'required|array',
            'items.*.name' => 'required',
            'items.*.weight' => 'required|numeric',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.description' => 'nullable',
        ];
    }
}

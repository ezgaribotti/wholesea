<?php

namespace Modules\Shipments\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateShippingCostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tracking_code' => 'required|exists:orders,tracking_code',
        ];
    }
}

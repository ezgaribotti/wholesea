<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => 'required|integer|exists:customers,id',
            'country_id' => 'required|integer|exists:countries,id',
            'full_street' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'state' => 'required',
            'description' => 'nullable',
        ];
    }
}

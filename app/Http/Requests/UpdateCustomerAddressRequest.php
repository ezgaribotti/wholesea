<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'country_id' => 'required|exists:countries,id',
            'full_street' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'state' => 'required',
            'description' => 'nullable',
        ];
    }
}

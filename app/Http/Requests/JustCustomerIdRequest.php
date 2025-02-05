<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JustCustomerIdRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => 'required|integer|exists:customers,id',
        ];
    }
}

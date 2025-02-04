<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required',
            'identity_document_type_id' => 'required|exists:identity_document_types,id',
            'identity_document' => 'required|unique:customers,identity_document',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable',
        ];
    }
}

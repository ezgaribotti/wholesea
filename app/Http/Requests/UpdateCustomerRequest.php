<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required',
            'status' => 'required|in:active,blocked',
            'identity_document_type_id' => 'required|exists:identity_document_types,id',
            'identity_document' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
        ];
    }
}

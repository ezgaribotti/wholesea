<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOperatorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required',
            'internal_code' => 'required',
            'email' => 'required|email',
            'status' => 'required|in:active,blocked',
        ];
    }
}

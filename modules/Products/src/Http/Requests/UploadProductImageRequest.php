<?php

namespace Modules\Products\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadProductImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sku' => 'required|exists:products,sku',
            'image' => 'required|image|mimes:webp|max:2048',
            'description' => 'required',
        ];
    }
}

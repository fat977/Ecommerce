<?php

namespace App\Http\Requests\Dashboard\Product\ProductSpec;

use Illuminate\Foundation\Http\FormRequest;

class ProductSpecRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'product_id'=>['required','integer','exists:products,id'], //263231231132
            'spec_id'=>['required','integer','exists:specs,id'],
            'value'=>['required','string','max:20'],
        ];
    }
}

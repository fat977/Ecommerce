<?php

namespace App\Http\Requests\Dashboard\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name_en'=>['required','string','max:256','min:2'],
            'name_ar'=>['required','string','max:256','min:2'],
            'price'=>['required','numeric','max:99999.99','min:1'],
            'code'=>['required','integer','digits:5','unique:products'],
            'quantity'=>['nullable','integer','max:999','min:1'],
            'desc_en'=>['required','string'],
            'desc_ar'=>['required','string'],
            'status'=>['required','integer','between:0,1'],
            'category_id'=>['required','integer','exists:categories,id'], //263231231132
            'brand_id'=>['required','integer','exists:brands,id'],
            'image'=>['nullable','image','max:1000','mimes:png,jpg,jpeg'],
        ];
    }
}

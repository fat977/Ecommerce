<?php

namespace App\Http\Requests\Dashboard\Product\Offer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OfferRequest extends FormRequest
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
            'title_en'=>['required','string','max:50','min:3', Rule::unique('offers')->ignore($this->offer)],
            'title_ar'=>['required','string','max:50','min:3',Rule::unique('offers')->ignore($this->offer)],
            'discount'=>['required'],
            'start_at'=>['required'],
            'end_at'=>['required']
        ];
    }
}

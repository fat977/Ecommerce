<?php

namespace App\Http\Requests\Dashboard\Product\Spec;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SpecRequest extends FormRequest
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
            'name_en'=>['required','string','max:50','min:3', Rule::unique('specs')->ignore($this->spec)],
            'name_ar'=>['required','string','max:50','min:3',Rule::unique('specs')->ignore($this->spec)],
        ];
    }
}

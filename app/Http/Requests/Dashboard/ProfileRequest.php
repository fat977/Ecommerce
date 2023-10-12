<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'current_password'=>'nullable|required_with:new_password|current_password',
            'new_password'=>'required_with:current_password|min:8|nullable',
            'confirm_password'=>'required_with:new_password|same:new_password',
        ];
    }
}

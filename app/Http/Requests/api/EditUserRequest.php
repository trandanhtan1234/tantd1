<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full' => 'required|max:20',
            'phone' => 'required|regex:/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/|unique:users,phone,'.$this->id.',id'
        ];
    }

    public function messages(): array
    {
        return [
            'full.required' => 'This field is required!',
            'full.max' => 'Full name cannot be more than 20 characters!',
            'phone.required' => 'This field is required!',
            'phone.regex' => 'Phone number is invalid!',
            'phone.unique' => 'Phone number is already used!'
        ];
    }
}

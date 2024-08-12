<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddValueRequest extends FormRequest
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
            'value_name' => 'required|unique:values,value'
        ];
    }

    public function messages(): array
    {
        return [
            'value_name.required' => 'Value Name is required!',
            'value_name.unique' => 'Value is already used!'
        ];
    }
}

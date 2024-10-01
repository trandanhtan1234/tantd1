<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAttributeRequest extends FormRequest
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
            'attr_name' => 'required|unique:attributes,name'
        ];
    }

    public function messages(): array
    {
        return [
            'attr_name.required' => 'Attribute Name is required!',
            'attr_name.unique' => 'Attribute Name is already used!'
        ];
    }
}

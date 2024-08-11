<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'name' => 'required|min:5|unique:products,name',
            'price' => 'required|numeric',
            'attr' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'This field is required!',
            'name.min' => 'Please enter a Product Name more than 5 characters!',
            'name.unique' => 'Product Name is already used!',
            'price.required' => 'This field is required!',
            'price.numeric' => 'Enter numbers only!',
            'attr.required' => 'Attribute\'s Values are required'
        ];
    }
}

<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

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

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}

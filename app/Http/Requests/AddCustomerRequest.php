<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCustomerRequest extends FormRequest
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
            'email' => 'required|email|unique:customer,email',
            'address' => 'required',
            'phone' => 'required|regex:/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/|unique:customer,phone'
        ];
    }

    public function message(): array
    {
        return [
            'full.required' => 'This field is required!',
            'full.max' => 'Full Name maxinum is 20 characters!',
            'email.required' => 'This field is required!',
            'email.email' => 'Email is invalid!',
            'email.unique' => 'Email already exists!',
            'address' => 'This field is required!',
            'phone.required' => 'This field is required!',
            'phone.regex' => 'Phone Number is invalid!',
            'phone.unique' => 'Phone Number already exists!'
        ];
    }
}

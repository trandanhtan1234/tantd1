<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'fname' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/'
        ];
    }

    public function messages(): array
    {
        return [
            'fname.required' => 'This field is required!',
            'address.required' => 'This field is required!',
            'email.required' => 'This field is required!',
            'email.email' => 'Email is invalid!',
            'phone.required' => 'This field is required!',
            'phone.regex' => 'Phone is invalid1'
        ];
    }
}

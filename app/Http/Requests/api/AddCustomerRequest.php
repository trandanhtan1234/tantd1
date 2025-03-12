<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

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
            'phone' => 'required|regex:/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/|unique:customer,phone',
            'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            'confirm_password' => 'required|same:password'
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
            'phone.unique' => 'Phone Number already exists!',
            'password.required' => 'This field is required!',
            'password.min' => 'Please enter a password more than 6 characters!',
            'password.regex' => 'Password is invalid',
            'confirm_password.required' => 'This field is required!',
            'confirm_password.same' => 'Confirm password does not match Password!'
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

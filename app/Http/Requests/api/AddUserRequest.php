<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class AddUserRequest extends FormRequest
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
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            'full' => 'required|max:20',
            'phone' => 'required|regex:/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/|unique:users,phone'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'This field is required!',
            'email.unique' => 'This email is already used!',
            'email.email' => 'Email format is incorrect!',
            'password.required' => 'This field is required!',
            'password.min' => 'Please enter a password more than 6 characters!',
            'password.regex' => 'Password is invalid',
            'full.required' => 'This field is required!',
            'full.max' => 'Full name cannot be more than 20 characters!',
            'phone.required' => 'This field is required!',
            'phone.regex' => 'Phone number is invalid!',
            'phone.unique' => 'Phone number is already used!'
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

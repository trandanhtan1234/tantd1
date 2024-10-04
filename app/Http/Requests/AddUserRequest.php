<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'confirm_password' => 'required|same:password',
            'full' => 'required|max:20',
            'phone' => 'required|regex:/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/|unique:users,phone'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'This field is required!',
            'email.unique' => 'This email is already used!',
            'email.email' => 'Email is incorrect!',
            'password.required' => 'This field is required!',
            'password.min' => 'Please enter a password more than 6 characters!',
            'password.regex' => 'Password is invalid',
            'confirm_password.required' => 'This field is required!',
            'confirm_password.same' => 'Confirm password does not match Password!',
            'full.required' => 'This field is required!',
            'full.max' => 'Full name cannot be more than 20 characters!',
            'phone.required' => 'This field is required!',
            'phone.regex' => 'Phone number is invalid!',
            'phone.unique' => 'Phone number is already used!'
        ];
    }
}

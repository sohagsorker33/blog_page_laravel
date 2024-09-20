<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
             'current_password'=>'required',
             'password'=>['required','confirmed'],
             'password_confirmation'=>'required'
        ];
    }

    public function messages(): array
    {
        return [
              'current_password.required' =>'Please fill in your current password',
              'password.required' =>'Please fill in your new password',
              'password_confirmation.required' =>'Please fill in your confirm password',
        ];
    }
}

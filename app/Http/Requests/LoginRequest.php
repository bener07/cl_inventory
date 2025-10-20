<?php

namespace App\Http\Requests;

class LoginRequest extends ApiRequest
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
            "email" => "required|string|exists:users",
            "password" => "required|string|min:5"
        ];
    }

    public function messages(){
        return [
            "email.required" => "Email parameter missing",
            "email.exists" => "Email not found",
            "password.required" => "Password missing",
            "password.min" => "Minimum of 5 characters",
        ];
    }
}

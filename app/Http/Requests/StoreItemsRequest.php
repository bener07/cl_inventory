<?php

namespace App\Http\Requests;

class StoreItemsRequest extends ApiRequest
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
            "name" => "required|string",
            "quantity" => "required|integer",
            "user_id" => "required|exists:users,id",
            "place_number" => "required|exists:places,number",
            "notes" => "string",
            "description" => "string",
            "image" => "image"
        ];
    }
}

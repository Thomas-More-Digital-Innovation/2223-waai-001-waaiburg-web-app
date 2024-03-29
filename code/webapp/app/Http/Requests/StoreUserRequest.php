<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "user_type_id" => "integer",
            "firstname" => "string|required",
            "surname" => "string|required",
            "birthdate" => "date|nullable",
            "email" => "string|required|unique:users",
            "password" => "string",
            "phoneNumber" => "string|nullable",
            "gender" => "string|nullable",
            "street" => "string|nullable",
            "houseNumber" => "string|nullable",
            "city" => "string|nullable",
            "zipcode" => "string|nullable",
            "survey" => "date|nullable",
        ];
    }
}

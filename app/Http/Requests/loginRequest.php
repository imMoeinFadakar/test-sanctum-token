<?php

namespace App\Http\Requests;

use App\Http\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;

class loginRequest extends FormRequest
{   

    use ApiResponse;
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
            //

            "national_id" => "required|exists:users,national_id",
            "password" => "required",
            "password_conformation" => "required"

        ];
    }

    public function failedValidation(Validator $validator)
    {
        return $this->errorResponse(400,

        $validator->errors(),
        
        'validation failed!');
    }

}

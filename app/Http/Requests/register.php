<?php

namespace App\Http\Requests;

use App\Http\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
class register extends FormRequest
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

            "name" => 'required|alpha',
            "username" => 'required|',
            "national_id" => 'required|unique:users,national_id',
            "email" => 'required|email|',
            "numbers" => 'required|',
            "age" => 'required|',
            "gender" => 'required|',
            "password" => 'required|',
            "c_password"  => 'required|',

        ];
    }

    public function failedValidation(Validator $validator)
    {
        return $this->successResponse(400,
    [

        "status" =>false,

        "message" => $validator->errors()

    ],
    'verifacation failed!');
        
    }

}

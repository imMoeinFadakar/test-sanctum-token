<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Http\Requests\register;
use App\Models\User;
use Carbon\Carbon;
use Dotenv\Validator;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Laravel\Sanctum\Contracts\HasAbilities;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authController extends apiController
{
    //

  

   
  
    public function register(Request $request,register $register, User $user)
    {
        

        // validaton request:
         $request->validate($register->rules());


        // store Data in database:
        $add_user =  $user->store($request);
        
        // Generate sanctum token:
       $token =  $add_user->createToken('app-register', )->plainTextToken;

        //Return json Response:
        return $this->successResponse(200,[

            "user" => $add_user,

            "token" => $token

        ], 'user Registered!');

    }

    public function login(request $request, loginRequest $loginRequest,User $user)
    {
        //validation login information:
        $request->validate($loginRequest->rules());

        //find national_id user:
       $founded_user = $user->findUserByNationalId($request);
            
       if(!Hash::check($request->password, $founded_user->password)){

        return $this->errorResponse('password not found!','test');

       }

            $token = $founded_user->createToken('app-login')->plainTextToken;


            return $this->successResponse(200,[

                "user" => $founded_user,

                "token" => $token

            ], 'user is logined!');  

    }




    public function logout()
    {
        
      auth::user()->tokens()->delete();

      return $this->successResponse(200,'logged out!');

    }

}

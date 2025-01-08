<?php 


namespace App\Http\Traits;


trait ApiResponse {


    public function successResponse($code,$data,$message = null)
    {

        return response()->json([

            "satatus" =>  true,

            "code" => $code,

            "data" => $data,

            "message" => $message

        ]);

    }

    public function errorResponse($code,$data,$message = null)
    {

        return response()->json([

            "satatus" =>  false,

            "code" => $code,

            "data" => $data,

            "message" => $message

        ]);

    }


}


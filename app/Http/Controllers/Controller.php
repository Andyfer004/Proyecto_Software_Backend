<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected function respondWithToken($token)
    {
        $user = Auth::user();

        
        return response()->json([
            'token' => $token,
            'user' => $user,
            "message" => "se ha logueado exitosamente",
            'token_type' => 'bearer',
            'expires_in' => 2000000000000000000000000000000000000000000000000000000
        ], 200);
    }
}

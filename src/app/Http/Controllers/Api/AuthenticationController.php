<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SendMessageRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Models\BlgUser;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{

    public function authLogin(LoginRequest $request){
        $userEmail = BlgUser::where(['email' => $request->email])->first();
        if(!$userEmail){
            return response()->json(['info' => 'Please check your input information again Email !',404]);
        }
        $userPassword = $userEmail->password; 
        $hashedPassword = \JwtUtils::generateHashedPassword($request->password);
        if (Hash::check($request->password, $userPassword)) {
            $accessToken = JWTAuth::fromUser($userEmail);
            $newToken = \JwtUtils::createNewAccessToken($accessToken);
            return response()->json($newToken, 200);
        } else {
            return response()->json(['info'=>'Please check your login information Password !'], 400);
        } 
    }


    public function authLogout()
    {
        Auth::logout();
        return response()->json(['info' => 'User logged out successfully']);
    }

    public function sendMessageInfo(SendMessageRequest $request){
        $msg = $request->message;
        return response()->json($msg);
    }

}

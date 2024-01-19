<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SendMessageRequest;

use App\Http\Requests\RegisterRequest;
use App\Models\BlgUser;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{

    public function authLogin(){

    }

    public function authRegister(RegisterRequest $request){
        try{
            $validatedData = $request->validated();

            $user = BlgUser::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password'])
            ]);
    
            return response()->json([
                'message' => 'Successfully created user!',
                'user info' => $user
            ], 200);

        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
        

    }

    public function authLogout(){

    }

    public function sendMessageInfo(SendMessageRequest $request){
        $msg = $request->message;
        return response()->json($msg);
    }


}

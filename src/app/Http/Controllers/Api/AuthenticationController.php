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
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginNotification;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticationController extends Controller
{
    public function authLogin(LoginRequest $request)
    {
        $userEmail = BlgUser::where(['email' => $request->email])->first();

        if (!$userEmail) {
            return response()->json(['info' => 'Please check your input information again Email !'], 404);
        }

        $userPassword = $userEmail->password;

        if (Hash::check($request->password, $userPassword)) {
            $accessToken = JWTAuth::fromUser($userEmail);
            $newAccessToken = \JwtUtils::createNewAccessToken($accessToken);
            $userEmail->update(['remember_token' => $accessToken]);

            session()->put('_token', $accessToken);

            try {
                Mail::to($userEmail->email)->send(new LoginNotification($userEmail, now()));
                return response()->json($newAccessToken, 200);
            } catch (\Exception $e) {
                \Log::error('Error sending login notification: ' . $e->getMessage());
            }

        } else {
            return response()->json(['info' => 'Please check your login information Password !'], 400);
        }
    }
    
    public function csrf()
    {
        $token = Str::random(255);
        session()->put('_token', $token);
        return response()->json(['csrf_token' => $token]);
    }

    // public function authLogout()
    // {
    //     Auth::logout();
    //     return response()->json(['info' => 'User logged out successfully']);
    // }

   public function authLogout()
{
    try {
        JWTAuth::invalidate(JWTAuth::getToken());
    } catch (JWTException $e) {
        // Nếu token invalid hoặc hết hạn thì vẫn xem như logout thành công
        // hoặc bạn có thể log lỗi ở đây
    }
    return response()->json(['info' => 'User logged out successfully']);
}




    public function getUser($userId)
    {
        $user = \User::getUserById($userId);
        if (!$user) {
            return response()->json(['error' => 'ID: '. $userId .' not found !'], 404);
        }

        return response()->json(['data' => $user], 200);
    }


    public function sendMessageInfo(SendMessageRequest $request){
        $msg = $request->message;
        return response()->json($msg);
    }

}

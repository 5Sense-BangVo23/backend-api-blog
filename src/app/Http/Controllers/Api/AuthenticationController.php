<?php

namespace App\Http\Controllers\Api;

use App\Constants\Messages;
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
    $steps = [
        'step' => '',
        'progress' => 0,
        'status' => 'processing'
    ];

    // ✅ Kiểm tra định dạng email trước
    if (!Str::endsWith($request->email, '@example.com')) {
        return response()->json([
            'step' => 'check_email_format',
            'progress' => 0,
            'status' => 'failed',
            'message' => 'Only emails ending with @example.com are allowed.'
        ], 400);
    }

    // ✅ Kiểm tra email có tồn tại không
    $userEmail = BlgUser::where(['email' => $request->email])->first();
    if (!$userEmail) {
        return response()->json([
            'step' => 'check_email',
            'progress' => 25,
            'status' => 'failed',
            'message' => 'Please check your input information again Email!'
        ], 404);
    }

    $steps['step'] = 'check_email';
    $steps['progress'] = 25;

    // ✅ Kiểm tra mật khẩu
    if (!Hash::check($request->password, $userEmail->password)) {
        return response()->json([
            'step' => 'check_password',
            'progress' => 50,
            'status' => 'failed',
            'message' => 'Please check your login information Password!'
        ], 400);
    }

    $steps['step'] = 'check_password';
    $steps['progress'] = 50;

    // ✅ Tạo token
    $accessToken = JWTAuth::fromUser($userEmail);
    $newAccessToken = \JwtUtils::createNewAccessToken($accessToken);
    $userEmail->update(['remember_token' => $accessToken]);
    session()->put('_token', $accessToken);

    $steps['step'] = 'token_created';
    $steps['progress'] = 75;

    // ✅ Gửi email
    try {
        Mail::to($userEmail->email)->send(new LoginNotification($userEmail, now()));
        $steps['step'] = 'email_sent';
        $steps['progress'] = 100;
        $steps['status'] = 'success';
        $steps['access_token'] = $newAccessToken;

        return response()->json($steps, 200);

    } catch (\Exception $e) {
        \Log::error('Error sending login notification: ' . $e->getMessage());

        return response()->json([
            'step' => 'email_sent',
            'progress' => 100,
            'status' => 'partial_success',
            'access_token' => $newAccessToken,
            'message' => 'Login success but failed to send email notification.'
        ], 200);
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
        }
    return response()->json(
        [ 'message' => Messages::USER_LOGGED_OUT ],
    );
    }




    public function getUser($userId)
    {
        $user = \User::getUserById($userId);
        if (!$user) {
            return response()->json(['error' => 'ID: '. $userId .' not found !'], 404);
        }

        return response()->json(['data' => $user], 200);
    }

    public function refreshToken(Request $request)
    {
        try {
            $token = JWTAuth::refresh(JWTAuth::getToken());
            return response()->json(['access_token' => $token], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not refresh token'], 500);
        }
    }


    public function sendMessageInfo(SendMessageRequest $request){
        $msg = $request->message;
        return response()->json($msg);
    }

}

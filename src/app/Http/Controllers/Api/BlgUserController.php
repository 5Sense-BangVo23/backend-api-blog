<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateBlgUserRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\BlgUser;
use App\Models\BlgRole;
use App\Http\Resources\Authentication\BlgUserResource;
use App\Notifications\PasswordUpdatedNotification;

class BlgUserController extends Controller
{
    //
    public function authRegister(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        // Call the createUser method from the UserService
        $result = \User::createUser(
            $validatedData['name'],
            $validatedData['email'],
            $validatedData['password']
        );

        // Check success from service
        if ($result['success']) {
            $userResource = new BlgUserResource($result['user']);
            \User::sendRegistrationEmail($result['user']);
            return response()->json([
                'success' => true,
                'message' => 'User registration successful',
                'data' => $userResource,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User registration failed',
                'error' => $result['message'],
            ], 500);
        }
    }

    public function index()
    {
        try {
            // Get all users
            $users = \User::getAllUsers();
           
            // Use the BlgUserResource to format the response
            $usersResource = BlgUserResource::collection($users);

            return response()->json([
                'success' => true,
                'message' => 'Users retrieved successfully',
                'data' => $usersResource, // Use the resource instance
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve users', 'message' => $e->getMessage()], 500);
        }
    }


    public function updateUser(UpdateBlgUserRequest $request, $userId)
    {
        $data = $request->all();
        $result = \User::updateUser($userId, $data);
    
        if ($result instanceof \App\Models\BlgUser) {
            // Successful update, construct the response
            return response()->json(['success' => true, 'message' => 'User information updated successfully', 'data' => $result], 200);
        } elseif (is_array($result) && array_key_exists('success', $result) && $result['success'] === false) {
            // Unsuccessful update with a specific error message
            return response()->json(['success' => false, 'message' => $result['message']], 400);
        } else {
            // Unexpected result, consider it as a failure
            return response()->json(['success' => false, 'message' => 'User update failed'], 500);
        }
    }
    
    public function resetPassword($email, ResetPasswordRequest $request)
    {
        try {
            $result = \User::resetPassword($email, $request);
            
            if ($result !== false) {
                $user = BlgUser::where('email', $email)->first();
                $user->notify(new PasswordUpdatedNotification());    
                return response()->json([
                    'success' => true,
                    'message' => 'Password reset email sent successfully',
                ], 200);
            } else {
                $errorMessage = $result['message'] ?? 'Password reset email failed';
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage,
                    'error' => $result['error'] ?? null,
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Password reset email failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}

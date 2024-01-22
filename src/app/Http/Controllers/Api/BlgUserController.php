<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\BlgUser;
use App\Models\BlgRole;
use App\Http\Resources\Authentication\BlgUserResource;

class BlgUserController extends Controller
{
    //
    public function authRegister(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        $result = \User::createUser(
            $validatedData['name'],
            $validatedData['email'],
            $validatedData['password']
        );

        if ($result['success']) {
            $userResource = new BlgUserResource($result['user']);

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
}

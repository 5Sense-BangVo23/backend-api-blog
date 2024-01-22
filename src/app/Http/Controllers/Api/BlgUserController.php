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
    public function authRegister(RegisterRequest $request){
        try {
            $validatedData = $request->validated();
    
            $user = BlgUser::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password'])
            ]);
    
            $role = BlgRole::where('name', 'ROLE_ADMIN')->first();
            dd($role);
            if (!$role) {
                return response()->json(["error" => "Role not found!"], 400);
            }
    
            $user->roles()->attach($role->id);
    
            // Use the BlgUserResource to format the response
            $userResource = new BlgUserResource($user);
    
            return response()->json([
                'success' => true,
                'message' => 'User registration successful',
                'data' => $userResource, // Use the resource instance
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'User registration failed', 'message' => $e->getMessage()], 500);
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

<?php
namespace App\Services;
use App\Models\BlgUser;
use App\Models\BlgRole;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;
use App\Traits\Loggable;
use App\Traits\BlgUserTrait;

class BlgUserService{

    use Loggable,BlgUserTrait;

    public function createUser($name, $email, $password)
    {
        try {
            // Create the user
            $user = BlgUser::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password)
            ]);

            // Find the "ROLE_ADMIN" role
            $role = BlgRole::where('name', 'ROLE_ADMIN')->first();

            // Attach the role to the user if found
            if ($role) {
                $user->roles()->attach($role->id);
            } else {
                // Log an error if the role is not found
                \Log::error('Error creating user: ROLE_ADMIN role not found');
            }

            return ['success' => true, 'user' => $user];
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            \Log::error('Error creating user: ' . $e->getMessage());

            // Return an error response
            return ['success' => false, 'message' => 'Error creating user'];
        }
    }
    

    public function updateUser($userId, $data)
    {
        try {
            $user = BlgUser::findOrFail($userId);
    
            // Update basic information
            $updateData = [
                'name' => $data['name'] ?? $user->name,
                'email' => $data['email'] ?? $user->email,
            ];
            // Perform the update
            $user->update($updateData);
    
            // Return the updated user object
            return $user->fresh(); // Use fresh() to get the updated data
        } catch (\Exception $e) {
            // Log the exception
            \Log::error($e);
    
            // You can choose to throw an exception or return null/false here
            // depending on how you want to handle errors in your controller
            return null;
        }
    }
     
    public function resetPassword($email, $request)
    {
        try {
            // Check if the user exists
            $user = BlgUser::where('email', $email)->first();
    
            if (!$user) {
                // Indicate that the user is not found
                return false;
            }
    
            $newPassword = null;
            // Update user's password if provided in the request
            if ($request->has('password')) {
                $newPassword = $request->input('password');
    
                // Store the new password in the database
                $user->update([
                    'password' => Hash::make($newPassword),
                ]);
    
                // Send an email to the user with the new password
            }
    
            // If no new password provided, generate a unique token
            $token = bin2hex(random_bytes(32));
    
            // Store the token in the database
            PasswordReset::create([
                'email' => $email,
                'token' => $token,
            ]);
    
            // Send an email to the user with a link containing the token
            Mail::to($email)->send(new PasswordResetMail($token, $newPassword));
    
            // Indicate that the reset email was sent successfully
            return true;
        } catch (\Exception $e) {
            // Log any errors that occur during the password reset process
            \Log::error($e);
    
            return false;
        }
    }
    
    
}
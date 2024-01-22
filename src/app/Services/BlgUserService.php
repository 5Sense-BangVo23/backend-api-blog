<?php
namespace App\Services;
use App\Models\BlgUser;
use App\Models\BlgRole;
use App\Traits\Loggable;
use Illuminate\Support\Facades\Hash;
use App\Traits\BlgUserTrait;

class BlgUserService{

    use Loggable,BlgUserTrait;

    public function createUser($name, $email, $password)
    {
        try {
            $user = BlgUser::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password)
            ]);

            $role = BlgRole::where('name', 'ROLE_ADMIN')->first();
            if (!$role) {
                return ['success' => false, 'message' => 'Role not found!'];
            }

            $user->roles()->attach($role->id);

            return ['success' => true, 'user' => $user];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
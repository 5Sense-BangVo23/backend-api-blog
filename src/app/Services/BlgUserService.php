<?php
namespace App\Services;
use App\Models\BlgUser;
use App\Traits\Loggable;
use App\Traits\BlgUserTrait;

class BlgUserService{

    use Loggable,BlgUserTrait;

    protected function getUserIdByRole($roleName)
    {
        $userId = BlgUser::whereHas('roles', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        })->pluck('id')->first();

        $this->logMessage("User ID: ".$userId);

        return $userId;
    }

    public function getAllUsers()
    {
        try {
            $users = BlgUser::all();
            $this->logMessage("Loaded all user");
            return $users;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
<?php
namespace App\Services;
use App\Models\BlgUser;

class BlgUserService{
    protected function getUserIdByRole($roleName)
    {
        $userId = BlgUser::whereHas('roles', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        })->pluck('id')->first();

        return $userId;
    }

    public function getAllUsers()
    {
        try {
            $users = BlgUser::all();

            return $users;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
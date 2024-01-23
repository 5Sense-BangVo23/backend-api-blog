<?php

namespace App\Traits;
use App\Models\BlgUser; 

trait BlgUserTrait{
    public function getUserById($userId)
    {
        try {
            $user = BlgUser::findOrFail($userId);
            return $user;
        } catch (\Exception $e) {
            throw $e;
        }
    }

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
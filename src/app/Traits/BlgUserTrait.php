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
}
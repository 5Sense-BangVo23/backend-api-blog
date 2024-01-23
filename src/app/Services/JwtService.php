<?php
namespace App\Services;

use Illuminate\Support\Str;
use App\Models\BlgUser;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Authentication\JwtResource;

class JwtService{

    // Generate a dynamic value
    private function generateDynamicValue()
    {
        $uniqid = uniqid(mt_rand(), false);
        return substr($uniqid, 0, 16);
    }


    public function generateHashedPassword($userInputPassword) {
        
        $dynamicValue = $this->generateDynamicValue();
      
        $combinedString = $dynamicValue . $userInputPassword;
       
        return Hash::make($combinedString);
    }

    public function createNewAccessToken($token)
    {
        $jwt = JwtResource::make($token);
        return  $jwt;
    }
}


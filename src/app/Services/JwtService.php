<?php
namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Authentication\JwtResource;

class JwtService{

    // Generate a dynamic value
    private function generateDynamicValue(){
        return uniqid(mt_rand(), true);
    }

    public function generateHashedPassword($userInputPassword) {
        
        $dynamicValue = $this->generateDynamicValue();
      
        $combinedString = $dynamicValue . $userInputPassword;
       
        return Hash::make($combinedString);
    }

    public function createNewAccessToken($token)
    {
        $jwt = JwtResource::make($token);
        // dd( $jwt);
        return $jwt;
    }
}


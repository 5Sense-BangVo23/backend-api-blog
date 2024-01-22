<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\BlgUser;
use App\Models\BlgRole;

class BlgUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 'ROLE_ADMIN' role if it doesn't exist
        $roleAdmin = BlgRole::where('name', 'ROLE_ADMIN')->first();
        if (!$roleAdmin) {
            $roleAdmin = BlgRole::create(['name' => 'ROLE_ADMIN']);
        }

        // Create admin user
        BlgUser::create([
            'name' => 'admin',
            'email' => 'bangvo.5sense.vn@gmail.com',
            'password' => Hash::make('admin'),
        ])->roles()->attach($roleAdmin->id);
    }
}

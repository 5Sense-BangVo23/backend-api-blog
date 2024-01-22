<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlgRole;

class BlgRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createRoleIfNotExists('ROLE_ADMIN');
        $this->createRoleIfNotExists('ROLE_EDITOR');
        $this->createRoleIfNotExists('ROLE_AUTHOR');
        $this->createRoleIfNotExists('ROLE_READER');
    }

    private function createRoleIfNotExists($roleName)
    {
        $existingRole = BlgRole::where('name', $roleName)->first();

        if (!$existingRole) {
            BlgRole::create([
                'name' => $roleName
            ]);
        }
    }
}

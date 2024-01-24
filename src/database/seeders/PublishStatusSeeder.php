<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PublishStatus;

class PublishStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Draft',
            'Pending Review',
            'Published',
            'Out of Print',
            'Unavailable',
            'Archived',
            'Coming Soon',
            'On Hold',
            'Reprint',
            'Limited Edition',
            'In Progress',
        ];

        foreach ($statuses as $status) {
            PublishStatus::create(['name' => $status]);
        }
    }

    // php artisan db:seed --class=PublishStatusSeeder

}

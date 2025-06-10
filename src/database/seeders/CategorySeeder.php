<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Sơn bóng',
            'description' => 'Các loại sơn bóng cho móng tay với độ bóng cao, tạo cảm giác sang trọng.'
        ]);

        Category::create([
            'name' => 'Sơn lì',
            'description' => 'Sơn không bóng, mang lại vẻ đẹp tinh tế và hiện đại.'
        ]);

        Category::create([
            'name' => 'Sơn nhũ',
            'description' => 'Sơn có ánh kim tuyến lấp lánh, thích hợp cho tiệc tùng.'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\NailPolishProduct;
use Illuminate\Database\Seeder;

class NailPolishProductSeeder extends Seeder
{
    public function run(): void
    {
        NailPolishProduct::create([
            'name' => 'Hồng Phấn Dịu Dàng',
            'code' => 'HPDD01',
            'brand_id' => 1,
            'category_id' => 1,
            'color_code' => '#FFC0CB',
            'color_name' => 'Hồng phấn',
            'finish_type' => 'Bóng',
            'volume_ml' => 10,
            'dry_time_seconds' => 60,
            'durability_days' => 7,
            'is_vegan' => true,
            'is_cruelty_free' => true,
            'is_toxic_free' => true,
            'price_vnd' => 95000,
            'currency' => 'VND',
            'manufacture_date' => now()->subMonths(1),
            'expiry_date' => now()->addYears(2),
            'barcode' => '8938500123456',
            'usage_instructions' => 'Lắc đều trước khi dùng. Sơn 2 lớp để đạt màu chuẩn.',
            'warning_notes' => 'Tránh xa tầm tay trẻ em.',
            'storage_instructions' => 'Bảo quản nơi thoáng mát, tránh ánh nắng trực tiếp.'
        ]);

        NailPolishProduct::create([
            'name' => 'Đỏ Quyến Rũ',
            'code' => 'DQR02',
            'brand_id' => 2,
            'category_id' => 2,
            'color_code' => '#8B0000',
            'color_name' => 'Đỏ đô',
            'finish_type' => 'Lì',
            'volume_ml' => 12,
            'dry_time_seconds' => 70,
            'durability_days' => 10,
            'is_vegan' => false,
            'is_cruelty_free' => true,
            'is_toxic_free' => true,
            'price_vnd' => 105000,
            'currency' => 'VND',
            'manufacture_date' => now()->subMonths(2),
            'expiry_date' => now()->addYears(1)->addMonths(6),
            'barcode' => '8938500654321',
            'usage_instructions' => 'Sơn 1-2 lớp tuỳ theo độ đậm mong muốn.',
            'warning_notes' => 'Tránh tiếp xúc với mắt.',
            'storage_instructions' => 'Đậy nắp kỹ sau khi sử dụng.'
        ]);
    }
}

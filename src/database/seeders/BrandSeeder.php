<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Brand::create([
            'name' => 'Sơn Tím Mộng Mơ',
            'country' => 'Việt Nam',
            'website' => 'https://sontimmongmo.vn',
            'logo_url' => 'https://example.com/logo-vn1.png'
        ]);

        Brand::create([
            'name' => 'Bóng Nail',
            'country' => 'Hàn Quốc',
            'website' => 'https://bongnail.kr',
            'logo_url' => 'https://example.com/logo-kr2.png'
        ]);

        Brand::create([
            'name' => 'Móng Xinh',
            'country' => 'Pháp',
            'website' => 'https://mongxinh.fr',
            'logo_url' => 'https://example.com/logo-fr3.png'
        ]);
    }
}

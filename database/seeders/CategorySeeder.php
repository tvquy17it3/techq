<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cate1 = Category::create([
            'name' => 'Công nghệ', 
            'slug' => 'cong-nghe',
        ]);
        
        $cate2 = Category::create([
            'name' => 'Đời sống', 
            'slug' => 'doi-song',
        ]);

        $cate3 = Category::create([
            'name' => 'Bản nháp', 
            'slug' => 'ban-nhap',
        ]);
    }
}

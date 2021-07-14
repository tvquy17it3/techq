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
        $admin = Category::create([
            'name' => 'Công nghệ', 
            'slug' => 'cong-nghe',
        ]);
        
        $editor = Category::create([
            'name' => 'Đời sống', 
            'slug' => 'doi-song',
        ]);
    }
}

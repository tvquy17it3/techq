<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'Admin', 
            'slug' => 'admin',
            'permissions' => [
                'post.all' => true,
            ]
        ]);
        
        $editor = Role::create([
            'name' => 'Biên tập viên', 
            'slug' => 'editor',
            'permissions' => [
                'post.update' => true,
                'post.publish' => true,
            ]
        ]);

        $author = Role::create([
            'name' => 'Tác giả', 
            'slug' => 'author',
            'permissions' => [
                'post.create' => true,
            ]
        ]);
    }
}

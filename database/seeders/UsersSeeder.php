<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::where('slug', 'admin')->first();
        $author = Role::where('slug', 'author')->first();
        $editor = Role::where('slug', 'editor')->first();

        $admin1 = User::create([
            'name' => 'Admin', 
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234567890'),
            'remember_token' => Str::random(10),
        ]);
        $admin1->roles()->attach($admin);

        $editor1= User::create([
            'name' => 'Van Quy', 
            'email' => 'tranvanquy221198@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234567890'),
            'remember_token' => Str::random(10)
        ]);
        
        $editor1->roles()->attach($editor);

        $auth1 = User::create([
            'name' => 'Tran Van Quy', 
            'email' => 'tvquy.17it3@vku.udn.vn',
            'email_verified_at' => now(),
            'password' => bcrypt('1234567890'),
            'remember_token' => Str::random(10),
        ]);
        $auth1->roles()->attach($author);

        $auth2 = User::create([
            'name' => 'Quy', 
            'email' => 'vanquy.dev@gmail.com',
            'password' => bcrypt('1234567890'),
            'remember_token' => Str::random(10),
        ]);
        $auth2->roles()->attach($author);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();RolesSeeder::class,$auth2->roles()->attach($author); https://stackoverflow.com/questions/55329038/call-to-a-member-function-roles-on-null-in-laravel
        // User::factory(5)->create();
        // $rolesA = \App\Models\Role::where('slug', 'author')->first();
        // \App\Models\User::all()->each(function ($user) use ($rolesA) { 
        //     if ($user->roles->isEmpty()) {
        //         $user->roles()->attach($rolesA); 
        //     }
        // });

        // $this->call(RolesSeeder::class);
        // $this->call(UsersSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(PostsSeeder::class);

        $rolesA = \App\Models\Role::where('slug', 'author')->first();
        User::chunk(50, function ($users) use ($rolesA) {
            foreach ($users as $user) {
                if ($user->roles->isEmpty()) {
                    $user->roles()->attach($rolesA); 
                }
            }
        });
    }
}

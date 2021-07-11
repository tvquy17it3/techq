<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $title = $this->faker->sentence($nbWords = 6, $variableNbWords = true);
        return [
              'title' => $title,
              'body' => $this->faker->text($maxNbChars = 2000),
              'slug' => Str::slug($title, '-'),
              'thumbnail' =>'https://static.tapchitaichinh.vn/600x315/images/upload/duongthanhhai/05082020/15-dia-diem-du-lich-hot-nhat-viet-nam.jpg',
              'published' => rand(0,1),
              'user_id' =>  User::all()->random()->id
        ];
    }
}
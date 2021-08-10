<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
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
        $cate = Category::pluck('id')->random();
        $title = $this->faker->sentence($nbWords = 6, $variableNbWords = true);

        return [
              'title' => $title,
              'body' => $this->faker->text($maxNbChars = 2000),
              'slug' => Str::slug($title, '-'),
              'thumbnail' =>'http://localhost:8000/storage/photos/1/download (5).jpeg',
              'category_id'=> $cate,
              'views'=>0,
              'published' => rand(0,1),
              'user_id' =>  User::pluck('id')->random()
        ];
    }
}
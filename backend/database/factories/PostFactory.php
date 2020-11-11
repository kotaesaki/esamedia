<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

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
        return [
            'post_author' => $this->faker->numberBetween($min = 1, $max = 5),
            'post_title' => $this->faker->title,
            'post_content' => $this->faker->realText(),
            'post_date' => $this->faker->datetime($max = 'now', $timezone = date_default_timezone_get()),
            'post_modified' => $this->faker->datetime($max = 'now', $timezone = date_default_timezone_get()),
            'file_name' => 'index.png',
            'file_path' => 'Desktop/',
            'post_status' => 'private',
        ];
    }
}

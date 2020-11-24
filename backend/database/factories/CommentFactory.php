<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment_post_id' => '1',
            'comment_author' => $this->faker->name,
            'comment_author_email' => $this->faker->safeEmail,
            'comment_author_url' => 'https://github.com/kotaesaki/esamedia',
            'comment_content' => $this->faker->realText(),
            'comment_author_ip' => '172.22.0.1'
        ];
    }
}

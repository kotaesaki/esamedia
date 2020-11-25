<?php

namespace Database\Factories;

use App\Models\Term;
use Illuminate\Database\Eloquent\Factories\Factory;

class TermFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Term::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'term_name' => $this->faker->title,
            'term_slug' => $this->faker->slug,
            'term_description' => $this->faker->realText(100),
            'taxonomy' => 'category',
            'parent' => $this->faker->numberBetween($min = 0, $max = 2)
        ];
    }
}

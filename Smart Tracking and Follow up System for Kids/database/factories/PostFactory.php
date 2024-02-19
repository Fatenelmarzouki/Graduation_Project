<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'problem' => $this->faker->text(200),
            'take_action' => $this->faker->text(200),
            'requirements' => $this->faker->text(200),
            'father_reply' => $this->faker->text(200),
            'emp_id' =>8,
            'child_id'=>5,
            'father_id'=>10,
        ];
    }
}

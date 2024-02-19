<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Selectedfood>
 */
class SelectedfoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'count'=> $this->faker->numberBetween(0,5),
            "food_id"=>$this->faker->unique()->numberBetween(1,8)
        ];
    }
}
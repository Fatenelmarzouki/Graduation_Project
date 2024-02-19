<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Chocolate',
                'Chips',
                'Cookies',
                'Soda',
                'Candy',
                'Biscuits',
                'Dount',
                'Juice'
            ]),
            'calories' => $this->faker->numberBetween(100, 500),
            'admin_id' => 1
        ];
    }
}

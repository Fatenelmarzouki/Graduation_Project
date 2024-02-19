<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $behave = $this->faker->randomElement(['Turbulent', 'Conformist', 'Solitary', 'Friendly']);
        $team = $this->faker->randomElement(['Excellent', 'Very Good', 'Good', 'Acceptable']);
        $evaluation= $this->faker->randomElement(['Excellent', 'Very Good', 'Good', 'Acceptable']);
        $child = $this->faker->unique()->numberBetween(1,10);
        return [
            'mark'=>$this->faker->randomFloat(null,5,70),
            'behavior'=>$behave,
            'team_work'=>$team,
            'performance_evaluation'=>$evaluation,
            'child_id'=>$child
        ];
    }
}

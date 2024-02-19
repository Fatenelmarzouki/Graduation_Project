<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
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
        $activity = $this->faker->randomElement(['Excellent', 'Very Good', 'Good', 'Acceptable']);
        $interact = $this->faker->randomElement(['Excellent', 'Very Good', 'Good', 'Acceptable']);
        $subject = $this->faker->numberBetween(1,7);
        $father = $this->faker->unique()->numberBetween(1,10);
        return [
            'mark'=>$this->faker->randomFloat(null,5,70),
            'behavior'=>$behave, 
            'activity'=>$activity,
            'interact'=>$interact,
            'team_work'=>$team,
            'father_id'=>$father,
            'subjectdataset_id'=>$subject
        ];
    }
}

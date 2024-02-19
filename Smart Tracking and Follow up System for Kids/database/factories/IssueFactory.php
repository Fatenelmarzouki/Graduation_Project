<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Issue>
 */
class IssueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $from = $this->faker->randomElement(['Child', 'Employee', 'Family', 'Others']);
        $reason = $this->faker->randomElement(['Psychologically', 'Healthily', 'Difficulty in Compatibility', 'Economically', 'Others']);
        return [
            'problem' =>$this->faker->text(200),
            'from'=>$from,
            'reason' =>$reason,
            'take_action' => $this->faker->text(200),
            'emp_id'=> 8,
            'child_id'=>5,
        ];
    }
}

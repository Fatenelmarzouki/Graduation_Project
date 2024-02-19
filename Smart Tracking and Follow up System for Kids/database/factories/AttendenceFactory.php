<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendence>
 */
class AttendenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $date = $this->faker->date($format = 'Y-m-d', $max = 'now');
        $status = $this->faker->randomElement(['Presence', 'Absence']);
        $child = $this->faker->numberBetween(1,10);
        $emp = $this->faker->randomElement([2,8,9]);
        return [
            'attendence_date'=>$date,
            'attendence_status'=>$status,
            'child_id'=>$child,
            'emp_id'=>$emp
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HealthReport>
 */
class HealthReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'report'=>$this->faker->text(200),
            "child_id"=>5,
            "father_id"=>10,
            "emp_id"=>7
        ];
    }
}

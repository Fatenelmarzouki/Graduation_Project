<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Healthdatasetname>
 */
class HealthdatasetnameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'dis_name'=>$this->faker->unique()->randomElement([
                'Heart',
                'Allergic',
                'Diabetes',
                'Vision Impairment'
            ]),
            'admin_id'=>1
        ];
    }
}
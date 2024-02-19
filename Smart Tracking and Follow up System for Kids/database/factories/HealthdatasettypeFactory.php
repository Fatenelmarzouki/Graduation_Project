<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Healthdatasettype>
 */
class HealthdatasettypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'dis_type'=>$this->faker->randomElement([
                'type_1',
                'type_2',
                'type_3',
                'type_4',
                'type_5',
                'type_6',                
                'type_7',
                'type_8',
                'type_9',
            ]),
            'admin_id'=>1,
            "healthdatasetname_id"=>$this->faker->numberBetween(1,4),
        ];
    }
}

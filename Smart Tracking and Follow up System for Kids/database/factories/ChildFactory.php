<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Child>
 */
class ChildFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(["male","female"]);
        $grade = $this->faker->randomElement(['1', '2', '3', '4', '5', '6']);
        $health = $this->faker->randomElement(['normal', 'special']);
        $blood = $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
        $class = $this->faker->randomElement(["A","B","C"]);
        $activity = $this->faker->numberBetween(1,5);
        return [
            "name"=>$this->faker->firstName($gender),
            "age"=>$this->faker->numberBetween(8,14),
            "grade"=>$grade,
            "gender"=>$gender,
            "health_condition"=>$health,
            "father_id"=>$this->faker->unique()->numberBetween(1,10),
            "height"=>$this->faker->numberBetween(80,150),
            "weight"=>$this->faker->numberBetween(20,70),
            "blood"=>$blood,
            "class"=>$class,
            "admin_id"=>1,
            "activitydataset_id"=>$activity
        ];
    }
}

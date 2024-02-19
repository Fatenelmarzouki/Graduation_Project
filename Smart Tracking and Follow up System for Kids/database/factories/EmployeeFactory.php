<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(["male","female"]);
        $subject = $this->faker->numberBetween(1,7);
        $activity = $this->faker->numberBetween(1,5);
        $pass = bcrypt($this->faker->password(6,20));
        $access_token = Str::random(64);
        return [
            "name"=>$this->faker->name($gender),
            "email"=>$this->faker->email(),
            "password"=>$pass,
            "job_title"=>$this->faker->randomElement(['Doctor', 'Teacher', 'Manager', 'Seller']),
            "address"=>$this->faker->address(),
            "image"=>$this->faker->imageUrl(640,480),
            "phone"=>$this->faker->phoneNumber(),
            "access_token"=>$access_token,
            "admin_id"=>1,
            "subjectdataset_id"=>$subject,
            "activitydataset_id"=>$activity
        ];
    }
}

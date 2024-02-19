<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Father>
 */
class FatherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male','female']);
        $pass = bcrypt($this->faker->password(6,20));
        $access_token = Str::random(64);
        return [
            "name"=>$this->faker->name($gender),
            "email"=>$this->faker->email(),
            "password"=>$pass,
            "address"=>$this->faker->address(),
            "phone"=>$this->faker->phoneNumber(),
            "gender"=>$gender,
            "username"=>"parent".$this->faker->firstName($gender),
            "admin_id"=>1,
            "access_token"=>$access_token,
        ];
    }
}

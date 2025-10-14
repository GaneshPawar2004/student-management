<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name'  => $this->faker->lastName(),
            'email'      => $this->faker->unique()->safeEmail(),
            'phone'      => $this->faker->optional()->e164PhoneNumber(),
            'dob'        => $this->faker->optional()->date(),
            'gender'     => $this->faker->randomElement(['male','female','other']),
            'roll_no'    => strtoupper($this->faker->bothify('R####')),
            'photo_path' => null,
            'address'    => $this->faker->optional()->address(),
        ];
    }
}

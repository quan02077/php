<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'class_name' => $this->faker->randomElement(['15DHCNTT01', '15DHCNTT02', '15DHCNTT03', '15DHPM01']),
            'age' => $this->faker->numberBetween(16, 25),
            'gender' => $this->faker->randomElement(['male', 'female']),
        ];
    }
}

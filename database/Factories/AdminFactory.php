<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    public function definition()
    {
        $faker = \Faker\Factory::create();
        return [
            'full_name' => $faker->name(),
            'age' => 21,
            'email' => $faker->safeEmail(),
            'password' => password_hash('123456789', PASSWORD_BCRYPT),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
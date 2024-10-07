<?php

namespace Database\Factories;

use App\Enums\RoleEnums;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
            'commercial' => $this->faker->unique()->regexify('[A-Z0-9]{10}'), //? 
            'tax' => $this->faker->unique()->regexify('[A-Z0-9]{15}'), //?
            'address' => $this->faker->address(),
            'role' => RoleEnums::USER->value,
            'email_verified_at' => $this->faker->optional()->dateTimeBetween('-1 years', 'now'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

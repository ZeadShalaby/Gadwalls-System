<?php

namespace Database\Factories;

use App\Models\User;
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
            'password' => 'Password1!',
            'commercial' => $this->faker->unique()->regexify('[A-Z0-9]{10}'), //? 
            'tax' => $this->faker->unique()->regexify('[A-Z0-9]{15}'), //?
            'address' => $this->faker->address(),
            'role' => RoleEnums::USER->value,
            'phone' => $this->faker->unique()->phoneNumber(),
            'email_verified_at' => $this->faker->optional()->dateTimeBetween('-1 years', 'now'),
        ];
    }


    /**
     * Configure the factory with relationships.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $img = ["images/users/users.png", "images/users/user1.png", "images/users/user2.png", "images/users/user3.png", "images/users/user5.png"];
            $increment = random_int(0, 3);
            $user->media()->create([
                'media' => $img[$increment],
            ]);
        });
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

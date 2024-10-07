<?php

namespace Database\Factories;

use App\Enums\RoleEnums;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SupplierFactory extends Factory
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
            'tax' => $this->faker->unique()->regexify('[A-Z0-9]{15}'), //?
            'address' => $this->faker->address(),
            'role' => RoleEnums::SUPPLIERS->value,
            'email_verified_at' => $this->faker->optional()->dateTimeBetween('-1 years', 'now'),
        ];
    }
}

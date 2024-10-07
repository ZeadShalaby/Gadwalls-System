<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SalebillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::all()->random()->id,
            'product_id' => Product::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'salary' => $this->faker->randomFloat(2, 1000, 100000),
            'notes' => $this->faker->unique()->regexify('[A-Z0-9]{15}'),
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
}

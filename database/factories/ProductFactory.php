<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'supplier_id' => Supplier::all()->random()->id, //? Supplier model
            'code' => $this->faker->unique()->randomNumber(8),
            'quantity' => $this->faker->numberBetween(0, 100),
            'expire_date' => Carbon::now()->addDays(rand(1, 365))->format('Y-m-d H:i:s'), // هنا نستخدم Carbon لتنسيق التاريخ
        ];
    }
}

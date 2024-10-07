<?php

namespace Database\Factories;

use App\Models\Supplier;
use App\Enums\StoreTypeEnums;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'type' => $this->faker->randomElement([StoreTypeEnums::SERVICE->value, StoreTypeEnums::COMPLEX->value, StoreTypeEnums::INVENTORY->value]),
            'supplier_id' => Supplier::all()->random()->id, //? Supplier model
            'address' => $this->faker->address(),
        ];
    }
}

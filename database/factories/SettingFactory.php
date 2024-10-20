<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    /**
     * Configure the factory with relationships.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Setting $setting) {
            $img = ["images/setting/setting.png", "images/setting/setting.png", "images/setting/setting.png", "images/setting/setting.png", "images/setting/setting.png"];
            $increment = random_int(0, 4);
            $setting->media()->create([
                'media' => $img[$increment],
            ]);
        });
    }
}

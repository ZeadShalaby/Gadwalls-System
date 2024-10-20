<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Store;
use App\Models\Product;
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
            'store_id' => Store::all()->random()->id,
            'code' => $this->faker->unique()->randomNumber(8),
            'quantity' => $this->faker->numberBetween(0, 100),
            'expire_date' => Carbon::now()->addDays(rand(1, 365))->format('Y-m-d H:i:s'), // هنا نستخدم Carbon لتنسيق التاريخ
        ];
    }


    /**
     * Configure the factory with relationships.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            //? Define the array of images
            $images = [
                "images/product/product.png",
                "images/product/product1.png",
                "images/product/product2.png",
                "images/product/product3.png",
                "images/product/product4.png",
                "images/product/product5.png",
                "images/product/product6.png",
                "images/product/product7.png",
                "images/product/product8.png",
                "images/product/product9.png",
                "images/product/product10.png",

            ];

            //? Randomly select 7 images if there are at least 7 images available
            $selectedImages = count($images) >= 7 ? array_rand(array_flip($images), 7) : $images;
            $discount = rand(5, 25);
            //? Store the selected images as a JSON array in the list_media field
            $product->media()->create([
                'list_media' => json_encode($selectedImages), // Store the images as a JSON array
            ]);

            $product->rival()->create([
                'rival' => $discount
            ]);
        });
    }


}

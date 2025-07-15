<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $datas = Product::all();
        $productIds = $datas->pluck('id')->toArray();
        return [
            'image' => fake()->imageUrl(640, 480, 'animals', true),
            'product_id' => fake()->randomElement($productIds),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}

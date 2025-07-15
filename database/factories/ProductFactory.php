<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $datas = ProductCategory::all();
        $productCategoryIds = $datas->pluck('id')->toArray();

        $imageUrl = "https://picsum.photos/640/480?random=".rand();
        $imageName = "image_".uniqid();
        file_put_contents(public_path('images/'.$imageName.'.jpg'),file_get_contents($imageUrl));

        return [
            'status' => fake()->boolean(),
            'name' => fake()->name(),
            'price' => fake()->randomNumber(7, false),
            'stock' => fake()->randomNumber(3, false),
            'main_image' => $imageName.'.jpg',
            'description' => fake()->randomHtml(2, 2),
            'product_category_id' => fake()->randomElement($productCategoryIds),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}

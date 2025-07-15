<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductCategory::class; // Đảm bảo đúng tên model
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();
        $slug = Str::slug($name);
        return [
            'status' => fake()->boolean(),
            'name' => $name,
            'slug' => $slug,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }

    /**
     * Định nghĩa một state tùy chỉnh để tạo Category với tên và slug cụ thể.
     *
     * @param string $name
     * @return static
     */
    public function withNameAndSlug(string $name): static
    {
        return $this->state(fn(array $attributes) => [
            'name' => $name,
            'slug' => Str::slug($name),
            'status' => fake()->boolean(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Shipper;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = [
            'truyện tranh',
            'truyện chữ',
            "tiểu thuyết",
            'sách văn học',
            'truyện trinh thám',
            'sách tham khảo', 
            'truyện kinh dị',
            'từ điển'
        ];
        foreach ($categories as $categoryName) {
            ProductCategory::factory()->withNameAndSlug($categoryName)->create();
        }
        User::factory(5)->create();
        User::factory()->admin()->create();
        //Shipper::factory(5)->create();
        Product::factory(10)->create();
        //ProductImage::factory(5)->create();
        //Cart::factory(10)->create();
        //Order::factory(5)->create();
    }
}

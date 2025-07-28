<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Shipper;
use App\Models\User;
use Database\Factories\ProductCategoryFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ProductCategoryFactory::customCategoryName();    
        // User::factory(5)->create();
        // User::factory()->admin()->create();   
        // Product::factory(25)->create();
        //$this->call(ProductImageSeeder::class);
        
        //Chưa
        //Shipper::factory(5)->create(); 
        //Cart::factory(10)->create();
        //Order::factory(5)->create();
    }
}

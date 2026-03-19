<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\User;
use Database\Seeders\CategoriesSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);



        User::factory(20)->create();

        Category::factory(20)->create();

        Product::factory(20)->create();

        ProductInventory::factory(20)->create();

        Cart::factory(20)->create();

        Order::factory(20)->create();

        OrderDetail::factory(20)->create();
    }
}

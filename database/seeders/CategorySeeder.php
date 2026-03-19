<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Database\Factories\CategoryFactory;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Electronics' => ['Mobiles', 'Laptops', 'Cameras', 'Headphones', 'Smart Watches'],
            'Fashion' => ['Men Shirts', 'Women Dresses', 'Jeans', 'Jackets', 'Shoes']
        ];

        foreach ($categories as $parent => $subs) {

            // Parent category
            $parentCategory = Category::factory()->parent($parent)->create();

            // Subcategories
            foreach ($subs as $sub) {
                Category::factory()->child($parentCategory->id, $sub)->create();
            }
        }
    }
}

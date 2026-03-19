<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition(): array
    {
        do {
            $user_id = User::inRandomOrder()->value('id');
            $product_id = Product::inRandomOrder()->value('id');

        } while (
            Cart::where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->exists()
        );

        return [
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => fake()->numberBetween(1,5),
            'price' => fake()->numberBetween(100,5000),
        ];
    }
}

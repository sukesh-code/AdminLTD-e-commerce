<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
  public function definition(): array
{
    return [
        'user_id' => \App\Models\User::inRandomOrder()->first()->id,
        'order_address' => fake()->address(),
        'final_discount' => fake()->numberBetween(0,500),
        'final_tax' => fake()->numberBetween(10,100),
        'final_amount' => fake()->numberBetween(500,5000),
        'status' => fake()->randomElement(['pending','booked','delivered']),
    ];
}
}

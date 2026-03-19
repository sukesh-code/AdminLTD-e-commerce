<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        // Ye normally fake data return karta hai
        // Lekin hum real data pass karenge seeder me
        return [
            'title' => 'Default Title',
            'parent_id' => null,
            'status' => 'Active'
        ];
    }

    // Optional helper: parent category banane ke liye
    public function parent(string $title)
    {
        return $this->state(function () use ($title) {
            return [
                'title' => $title,
                'parent_id' => null,
                'status' => 'Active'
            ];
        });
    }

    // Optional helper: subcategory banane ke liye
    public function child(int $parentId, string $title)
    {
        return $this->state(function () use ($parentId, $title) {
            return [
                'title' => $title,
                'parent_id' => $parentId,
                'status' => 'Active'
            ];
        });
    }
}

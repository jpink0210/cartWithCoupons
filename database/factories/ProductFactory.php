<?php

namespace Database\Factories;
use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
/**
 * pa make:factory ProductFactory --model=Product
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->randomDigit(),
            'title' => '測試產品',
            'price'  => $this->faker->numberBetween(100, 1000),
            'quantity' => $this->faker->numberBetween(10, 100)
        ];
    }
}

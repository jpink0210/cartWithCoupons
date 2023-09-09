<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Product;
use App\Models\CartItem;
use App\Models\Cart;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
/**
 * pa make:factory CartItemFactory --model=CartItem
 */
class CartItemFactory extends Factory
{
    protected $model = CartItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = $this->faker->randomDigit();
        $price = $this->faker->numberBetween(100, 1000);
        return [
            'cart_id' => Cart::factory(),
            'product_id' => Product::factory(),
            'quantity' => $quantity,
            'price'  => $price,
            'mart_coupon_id' => 0,
            'discount_amount' => 0,
            'total' => $quantity * $price
        ];
    }
}

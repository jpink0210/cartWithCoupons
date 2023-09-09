<?php

namespace Database\Factories;
use App\Models\Cart;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
/**
 * pa make:factory CartFactory --model=Cart
 */
class CartFactory extends Factory
{

    protected $model = Cart::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        return [
            'id' => $this->faker->randomDigit(),
            'user_id' => User::factory(),
            'checkouted' => 0
        ];
    }
}

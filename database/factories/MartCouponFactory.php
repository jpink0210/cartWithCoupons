<?php

namespace Database\Factories;
use App\Models\MartCoupon;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MartCoupon>
 */
/**
 * pa make:factory MartCouponFactory --model=MartCoupon
 */
class MartCouponFactory extends Factory
{

    protected $model = MartCoupon::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'type' => 'minus',
            'discount' => 15
        ];
    }
}

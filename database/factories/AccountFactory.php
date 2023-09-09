<?php

namespace Database\Factories;
use App\Models\Account;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
/**
 * pa make:factory AccountFactory --model=Account
 */
class AccountFactory extends Factory
{

    protected $model = Account::class;

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
            'account' => 'aa2@gmail.com',
            'deposit' => '5000',
            'infomation' => 'this is a info.'
        ];
    }
}

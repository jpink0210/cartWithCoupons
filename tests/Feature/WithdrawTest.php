<?php

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Account;

use Laravel\Passport\Passport;


/**
 * pa make:test Controller/AccountControllerTest
 */
class WithdrawTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    private $fakeUser2;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fakeUser3 = User::create([
            'name' => 'user003',
            'email' => 'ccc@gmail.com',
            'password' => 1234567890
        ]);
        Passport::actingAs($this->fakeUser3);
    }

    public function testMoneyWithdraw(): void
    {
        $account = Account::factory()->create(
            ['user_id' => $this->fakeUser3->id]
        );

        $response = $this->call(
            'PUT',
            'account/withdraw',
            ['amount' => 500, 'account' => $account]
        );
        $response->assertOk();
        
    }

    

}

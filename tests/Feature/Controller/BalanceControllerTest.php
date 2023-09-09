<?php

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;

/**
 * pa make:test Controller/BalanceControllerTest
 */
class BalanceControllerTest extends TestCase
{

    private $fakeUser4;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fakeUser4 = User::create([
            'name' => 'user004',
            'email' => 'dddddd@gmail.com',
            'password' => 1234567890
        ]);
        Passport::actingAs($this->fakeUser4);
    }
    /**
     * A basic feature test example.
     */
    public function testGetData(): void
    {
        $response = $this->call(
            'GET',
            'api/balance',
        );

        $response->assertOk();

    }

    
}

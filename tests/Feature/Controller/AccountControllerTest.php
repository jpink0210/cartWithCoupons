<?php

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

use Laravel\Passport\Passport;


/**
 * pa make:test Controller/AccountControllerTest
 */
class AccountControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    private $fakeUser2;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fakeUser2 = User::create([
            'name' => 'user002',
            'email' => 'bbb@gmail.com',
            'password' => 1234567890
        ]);

        Passport::actingAs($this->fakeUser2);
    }

    public function testMoneySave(): void
    {
        $response = $this->call(
            'PUT',
            'account/save',
            ['amount' => 500]
        );
        $response->assertOk();
        
    }
}

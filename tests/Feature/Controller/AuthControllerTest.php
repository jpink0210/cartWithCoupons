<?php

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use Laravel\Passport\Passport;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function testSignUp(): void
    {
        $response = $this->call(
            'POST',
            'signup'
        );

        $response->assertOk();
    }

    public function testLogout(): void
    {
        $response = $this->call(
            'GET',
            'logout'
        );

        $response->assertOk();
    }

}

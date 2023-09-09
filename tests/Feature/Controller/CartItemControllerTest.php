<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\MartCoupon;


use Laravel\Passport\Passport;


class CartItemControllerTest extends TestCase
{
    // 當執行測試，會每次refresh 測試資料庫
    use RefreshDatabase;

    private $fakeUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fakeUser = User::create([
            'name' => 'user001',
            'email' => 'aaaaaa@gmail.com',
            'password' => 1234567890
        ]);

        Passport::actingAs($this->fakeUser);
    }


    public function testStore(): void
    {
        $cart = Cart::factory()->create(
            ['user_id' => $this->fakeUser->id]
        );

        $product = Product::factory()->create();
        $response = $this->call(
            'POST',
            'cart_items',
            ['cart_id' => $cart->id, 'product_id' => $product->id, 'quantity' => 10],
        );
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $cartItem = CartItem::factory()->create();

        $response = $this->call(
            'PUT',
            'cart_items/'.$cartItem->id,
            ['quantity' => 5566 ],
        );
        $response->assertOk();

        $cartItem->refresh();

        $this->assertEquals(5566, $cartItem->quantity);
    }

    public function testDestroy(): void
    {
        $cartItem = CartItem::factory()->create();

        $response = $this->call(
            'DELETE',
            'cart_items/'.$cartItem->id
        );
        $response->assertOk();

        $cartItem = CartItem::find($cartItem->id);
        $this->assertNull($cartItem);
    }
}

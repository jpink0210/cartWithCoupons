<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;


use App\Models\Cart;
use App\Models\Product;
use App\Models\MartCoupon;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $req = $request->all();
        $product = Product::find($req['product_id']);

        $cart = Cart::find($req['cart_id']);
        
        $whickCartItem = $cart->cartItems()->where('product_id', $product->id)->first();

        $result = [];

        if ($whickCartItem) {
            $result = CartItem::find($whickCartItem->id);

            $newCount = $whickCartItem->quantity + $req['quantity'];
            $result->fill([
              'quantity' => $newCount,
              'total' => $newCount * $whickCartItem->price,
            ]);
            // do something
            $result->save();
        } else {
            $result = $cart->cartItems()->create(
                [
                  'product_id' => $product->id,
                  'price' => $product->price,
                  'quantity' => $req['quantity'],
                  'total' => $req['quantity'] * $product->price
                ]
            );
        }
        return response()->json([
            'name' => $product->title,
            'result' => $result
        ]);

        
    }

    /**
     * Display the specified resource.
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartItem $cartItem, $id)
    {
        //
        $req = $request->all();
        $item = CartItem::find($id);
        
        $item->fill([
            'quantity' => $req['quantity'],
            'total' => $req['quantity'] * $item->price
        ]);
        $item->save();

        return response()->json($item);
    }

    public function updateCoupon(Request $request, CartItem $cartItem, $id)
    {
        $item = CartItem::find($id);

        if ($item['mart_coupon_id'] !== 0) {
            return response()->json('已經有 coupon, 請先移除才能選取');
        }

        $req = $request->all();
        $martCoupon = MartCoupon::find($req['martCouponId']);
        $item = CartItem::find($id);
        
        if ($martCoupon->type === "multiply") {
            $item->fill([
                'total' => $item->quantity * ($item->price * $martCoupon->discount),
                'mart_coupon_id' => $req['martCouponId'],
                'discount_amount' => $item->quantity * ($item->price * (1 - $martCoupon->discount))
            ]);
        } else if ($martCoupon->type === "minus") {

            if ($item->price <= $martCoupon->discount) {
                return response()->json('商品價格太低，無法使用此折扣券');
            }

            $item->fill([
                'total' => $item->quantity * ($item->price - $martCoupon->discount),
                'mart_coupon_id' => $req['martCouponId'],
                'discount_amount' => $item->quantity * $martCoupon->discount
            ]);
        }
        
        $item->save();

        return response()->json('true');

    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItem $cartItem, $id)
    
    {
        $item = CartItem::find($id)->delete();
        
        return response()->json('remove success');

        //
    }

    /**
     * destroyCoupon
     */
    public function destroyCoupon(CartItem $cartItem, $id)
    
    {

        $item = CartItem::find($id);

        if ($item->mart_coupon_id === 0) {
            return response()->json('尚未使用優惠券，無法刪除');
        }

        $item->fill([
            'total' => $item->quantity * $item->price,
            'mart_coupon_id' => 0,
            'discount_amount' => 0
        ]);

        $item->save();

        return response()->json('remove success');

        //
    }

    
}

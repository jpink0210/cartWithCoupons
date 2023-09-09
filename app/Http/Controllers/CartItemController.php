<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;


use App\Models\Cart;
use App\Models\Product;

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItem $cartItem, $id)
    
    {
        $item = CartItem::find($id)->delete();
        
        return response()->json('remove success');

        //
    }
}

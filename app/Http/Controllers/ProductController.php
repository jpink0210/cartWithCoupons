<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function mart()
    {
        //
        $user = auth()->user();

        $cart_id = 0;
        // 確認 未登入/登入 狀態
        if ($user) {
            $cart = (new CartController)->index();
            $cart_id = $cart ? json_decode($cart->content())->id : 0;
        }

        $products = Product::all();
        return view('mart', ['products' => $products, 'cart_id' => $cart_id]);

    }

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
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Account;
use App\Models\Cart;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;

/**
 * pa make:controller AuthController
 */
class AuthController extends Controller
{
    //
    public function signup(CreateUser $request)
    {
        $validatedData = $request->validated();
        $user = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password'])
        ]);

        $user->save();

        Account::create([
            'user_id' => $user->id,
            'account' => $user->email,
            'deposit' => 0,
            'infomation' => '這是一個客戶的資料'
        ]);


        Cart::create([
            'user_id' => $user->id,
            'checkouted' => 0
        ]);


        // return response('success', 201);
    }
}

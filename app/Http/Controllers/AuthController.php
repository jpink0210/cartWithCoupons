<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Account;
use App\Models\Cart;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;

use Illuminate\Support\Facades\Auth;

use Lcobucci\JWT\Parser as JwtParser;
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

        $tokenResult = $user->createToken('Token');
        $tokenResult->token->save();

        return response(['token' => $tokenResult->accessToken]);


        // return response('success', 201);
    }


    public function logout(Request $request)
    {
        $user = $request->user();

        $value = $request->bearerToken();
        
        if ($value) {
            /**
             * https://github.com/laravel/passport/issues/103
             * 
             * https://stackoverflow.com/questions/73706249/call-to-a-member-function-revoke-on-null-exception
             */
            $token= app(JwtParser::class)->parse($value)->claims()->get('jti');
            $token= $request->user()->tokens->find($token);
            $token->revoke();
            /**
             * 狀態不匹配
             * https://laravel.tw/docs/5.1/authentication
             * 
             * auth logout not exist
             * https://stackoverflow.com/questions/57813795/method-illuminate-auth-requestguardlogout-does-not-exist-laravel-passport
             */
            Auth::guard('web')->logout();

            return response()->json([
                'message' => 'Successfully logged out'
            ]);
        }

        // $user->token()->revoke();

        
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if (!Auth::attempt($validatedData)) {
            return response('Unauthorized', 401);
        }
        // auth 套件的功能，如果 login 成功，自動把資料帶入 $request 裡面
        $user = $request->user();

        $tokenResult = $user->createToken('Token');
        $tokenResult->token->save();

        return response(['token' => $tokenResult->accessToken]);
    }
}

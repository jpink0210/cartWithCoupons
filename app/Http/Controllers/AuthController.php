<?php

namespace App\Http\Controllers;
use App\Models\User;

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
        dump($user);
        dd($user->id);
        // return response('success', 201);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $account = $user->accounts()->first();
        return view('member.dashboard', ['account' => $account]);
    }

    public function save(Request $request)
    {
        //
        $req = $request->all();

        if ($req['amount'] <= 0) {
            return response()->json('存款金額必須大於零');
        }

        $user = auth()->user();
        $account = $user->accounts()->first();

        $user->accounts()->update([
            'deposit' => $account->deposit + $req['amount']
        ]);

        return response()->json('true');
    }

    public function withdraw(Request $request, Account $account)
    {
        //
        $req = $request->all();

        if ($req['amount'] <= 0) {
            return response()->json('提款金額必須大於零');
        }


        $user = auth()->user();

        $account = $user->accounts()->first();

        if ($req['amount'] > $account->deposit) {
            return response()->json('提款金額必須小於存款金額');
        }

        $user->accounts()->update([
            'deposit' => $account->deposit - $req['amount']
        ]);

        return response()->json('true');
    }
}

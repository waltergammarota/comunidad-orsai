<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $balance = $user->getBalance();
        return response()->json([
            "status" => "success",
            "msg" => $balance
        ]);
    }
}

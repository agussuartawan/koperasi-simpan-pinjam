<?php

namespace App\Http\Controllers;

use App\Models\DepositBalance;
use Illuminate\Http\Request;

class DepositBalanceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $deposits = DepositBalance::with('client')->orderBy('updated_at', 'desc')->get();
        return view('deposit-balance.index', compact('deposits'));
    }
}

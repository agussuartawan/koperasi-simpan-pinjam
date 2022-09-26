<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\DepositBalance;
use App\Models\Loan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('dashboard', [
            'deposits' => DepositBalance::sum('amount'),
            'loans' => Loan::sum('total_amount'),
            'arrears' => 0,
            'clients' => Client::count()
        ]);
    }
}

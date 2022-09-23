<?php

namespace App\Http\Controllers;

use App\Models\Arrear;
use App\Models\Loan;
use App\Models\Payment;
use App\Models\PaymentOverdue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArearsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        DB::transaction(function () {
            $now = Carbon::now();
            Arrear::truncate();
            $payment_overdues = PaymentOverdue::where('overdue_date', '<=', $now)->get();
            foreach ($payment_overdues as $payment_overdue) {
                $loan_id = Loan::where('id', $payment_overdue->loan_id)->first()->id;
                Arrear::create([
                    'loan_id' => $loan_id,
                    'installment_to' => $payment_overdue->installment_to
                ]);
            }
        });
        $arrears = Arrear::with('loan')->get();
        return view('arrear.index', compact('arrears'));
    }

    public function show(Loan $loan)
    {
        return view('include.arrear.show', compact('loan'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArearsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $now = Carbon::now();
        $loans = Loan::where('is_paid', 0)->get();
        foreach ($loans as $loan) {
            $loan->date = Carbon::parse($loan->date);
            $installment = $loan->term->term_day;
            for ($i=1; $i <= $installment; $i++) { 
                $overdue_date[$i] = $loan->date->addDays(2);
            }
            

        }
    }
}

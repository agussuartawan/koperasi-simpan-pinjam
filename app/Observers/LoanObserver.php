<?php

namespace App\Observers;

use App\Models\Debt;
use App\Models\Loan;

class LoanObserver
{
    /**
     * Handle the Loan "created" event.
     *
     * @param  \App\Models\Loan  $loan
     * @return void
     */
    public function created(Loan $loan)
    {
        $debt = Debt::where('client_id', $loan->client_id);
        if (!$debt->exists()) {
            Debt::create([
                'client_id' => $loan->client_id,
                'amount' => $loan->total_amount
            ]);
        } else {
            $debt->increment('amount', $loan->total_amount);
        }
    }

    public function creating(Loan $loan)
    {
        $amount = (float)rounded($loan->amount);
        $bank_interest = (float)($loan->bank_interest / 100);
        $bank_interest_idr = $amount * $bank_interest;
        
        $loan->code = $loan->getNextCode();
        $loan->amount = $amount;
        $loan->bank_interest_idr = $bank_interest_idr;
        $loan->total_amount = $amount + $bank_interest_idr;
    }

    /**
     * Handle the Loan "updated" event.
     *
     * @param  \App\Models\Loan  $loan
     * @return void
     */
    public function updated(Loan $loan)
    {
        //
    }

    /**
     * Handle the Loan "deleted" event.
     *
     * @param  \App\Models\Loan  $loan
     * @return void
     */
    public function deleted(Loan $loan)
    {
        //
    }

    /**
     * Handle the Loan "restored" event.
     *
     * @param  \App\Models\Loan  $loan
     * @return void
     */
    public function restored(Loan $loan)
    {
        //
    }

    /**
     * Handle the Loan "force deleted" event.
     *
     * @param  \App\Models\Loan  $loan
     * @return void
     */
    public function forceDeleted(Loan $loan)
    {
        //
    }
}

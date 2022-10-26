<?php

namespace App\Observers;

use App\Models\Debt;
use App\Models\Loan;
use App\Models\Payment;

class PaymentObserver
{
    /**
     * Handle the Payment "created" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function created(Payment $payment)
    {
        $loan = Loan::where('id', $payment->loan_id)->first();
        if ($payment->payment_on == $loan->term->term_day) {
            $loan->is_paid = 1;
            $loan->save();
        }

        $debt = Debt::where('id', $payment->debt_id);
        if ($debt->exists()) {
            $debt->decrement('amount', $payment->amount);
        }
    }

    public function creating(Payment $payment)
    {
        $debt_id = Debt::where('client_id', $payment->client_id)->first()->id;
        $loan = Loan::where('id', $payment->loan_id)->first();
        $payment_on = Payment::where('loan_id', $payment->loan_id)->count() + 1;
        $amount = (float)$loan->total_amount / (float)$loan->term->term_day;

        $mulct = (float)$payment->mulct;
        $mulct_idr = $amount * ($mulct / 100);
        $total_amount = $amount + $mulct_idr;

        $payment->code = $payment->getNextCode();
        $payment->mulct_idr = $mulct_idr;
        $payment->payment_on = $payment_on;
        $payment->amount = $amount;
        $payment->total_amount = $total_amount;
        $payment->debt_id = $debt_id;
    }

    /**
     * Handle the Payment "updated" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function updated(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "deleted" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function deleted(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "restored" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function restored(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "force deleted" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function forceDeleted(Payment $payment)
    {
        //
    }
}

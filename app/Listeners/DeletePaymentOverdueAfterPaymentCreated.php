<?php

namespace App\Listeners;

use App\Events\PaymentCreated;
use App\Models\PaymentOverdue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeletePaymentOverdueAfterPaymentCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PaymentCreated  $event
     * @return void
     */
    public function handle(PaymentCreated $event)
    {
        $payment = $event->payment;
        PaymentOverdue::where('loan_id', $payment->loan_id)->where('installment_to', $payment->payment_on)->delete();
    }
}

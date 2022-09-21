<?php

namespace App\Listeners;

use App\Events\PaymentCreated;
use App\Models\Debt;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DecrementDebtAfterPaymentCreated
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
        $debt = Debt::where('id', $payment->debt_id);
        if ($debt->exists()) {
            $debt->decrement('amount', $payment->amount);
        }
    }
}

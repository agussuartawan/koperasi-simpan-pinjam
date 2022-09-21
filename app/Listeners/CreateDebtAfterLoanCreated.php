<?php

namespace App\Listeners;

use App\Events\LoanCreated;
use App\Models\Debt;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateDebtAfterLoanCreated
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
     * @param  \App\Events\LoanCreated  $event
     * @return void
     */
    public function handle(LoanCreated $event)
    {
        $loan = $event->loan;
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
}

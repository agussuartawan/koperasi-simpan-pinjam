<?php

namespace App\Listeners;

use App\Events\LoanCreated;
use App\Models\PaymentOverdue;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatePaymentOverdueAfterLoanCreated
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
        $overdue = Carbon::parse($loan->date)->addDays(2);
        for ($i = 0; $i < $loan->term->term_day; $i++) {
            PaymentOverdue::create([
                'loan_id' => $loan->id,
                'installment_to' => $i + 1,
                'overdue_date' => $overdue
            ]);
            $overdue = $overdue->addDays(2);
        }
    }
}

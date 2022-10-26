<?php

namespace App\Observers;

use App\Models\DepositBalance;
use App\Models\Withdrawal;

class WithdrawalObserver
{
    /**
     * Handle the Withdrawal "created" event.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return void
     */
    public function created(Withdrawal $withdrawal)
    {
        $deposit_balance = DepositBalance::where('client_id', $withdrawal->client_id);
        if ($deposit_balance->exists()) {
            $deposit_balance->decrement('amount', $withdrawal->amount);
        }
    }

    public function creating(Withdrawal $withdrawal)
    {
        $withdrawal->code = $withdrawal->getNextCode();
        $withdrawal->amount = rounded($withdrawal->amount);
        $withdrawal->deposit_balance_id = DepositBalance::where('client_id', $withdrawal->client_id)->first()->id;
    }

    /**
     * Handle the Withdrawal "updated" event.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return void
     */
    public function updated(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Handle the Withdrawal "deleted" event.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return void
     */
    public function deleted(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Handle the Withdrawal "restored" event.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return void
     */
    public function restored(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Handle the Withdrawal "force deleted" event.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return void
     */
    public function forceDeleted(Withdrawal $withdrawal)
    {
        //
    }
}

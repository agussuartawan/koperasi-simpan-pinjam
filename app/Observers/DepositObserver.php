<?php

namespace App\Observers;

use App\Models\Deposit;
use App\Models\DepositBalance;

class DepositObserver
{
    /**
     * Handle the Deposit "created" event.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return void
     */
    public function created(Deposit $deposit)
    {
        $deposit_balance = DepositBalance::where('client_id', $deposit->client_id);
        if (!$deposit_balance->exists()) {
            DepositBalance::create([
                'client_id' => $deposit->client_id,
                'amount' => $deposit->amount
            ]);
        } else {
            $deposit_balance->increment('amount', $deposit->amount);
        }
    }

    public function creating(Deposit $deposit)
    {
        $deposit->amount = rounded($deposit->amount);
        $deposit->code = $deposit->getNextCode();
    }

    /**
     * Handle the Deposit "updated" event.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return void
     */
    public function updated(Deposit $deposit)
    {
        //
    }

    /**
     * Handle the Deposit "deleted" event.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return void
     */
    public function deleted(Deposit $deposit)
    {
        //
    }

    /**
     * Handle the Deposit "restored" event.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return void
     */
    public function restored(Deposit $deposit)
    {
        //
    }

    /**
     * Handle the Deposit "force deleted" event.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return void
     */
    public function forceDeleted(Deposit $deposit)
    {
        //
    }
}

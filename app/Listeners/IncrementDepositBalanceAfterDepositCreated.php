<?php

namespace App\Listeners;

use App\Events\DepositCreated;
use App\Models\DepositBalance;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncrementDepositBalanceAfterDepositCreated
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
     * @param  \App\Events\DepositCreated  $event
     * @return void
     */
    public function handle(DepositCreated $event)
    {
        $deposit = $event->deposit;
        $deposit_balance = DepositBalance::where('client_id', $deposit->client_id);
        if ($deposit_balance->exists()) {
            $deposit_balance->increment('amount', $deposit->amount);
        }
    }
}

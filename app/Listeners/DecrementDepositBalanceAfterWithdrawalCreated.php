<?php

namespace App\Listeners;

use App\Events\WithdrawalCreated;
use App\Models\DepositBalance;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DecrementDepositBalanceAfterWithdrawalCreated
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
     * @param  \App\Events\WithdrawalCreated  $event
     * @return void
     */
    public function handle(WithdrawalCreated $event)
    {
        $withdrawal = $event->withdrawal;
        $deposit_balance = DepositBalance::where('client_id', $withdrawal->client_id);
        if ($deposit_balance->exists()) {
            $deposit_balance->decrement('amount', $withdrawal->amount);
        }
    }
}

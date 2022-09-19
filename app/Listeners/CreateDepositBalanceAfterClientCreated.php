<?php

namespace App\Listeners;

use App\Events\ClientCreated;
use App\Models\DepositBalance;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateDepositBalanceAfterClientCreated
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
     * @param  \App\Events\ClientCreated  $event
     * @return void
     */
    public function handle(ClientCreated $event)
    {
        $client = $event->client;
        DepositBalance::create([
            'client_id' => $client->id,
            'amount' => 0
        ]);
    }
}

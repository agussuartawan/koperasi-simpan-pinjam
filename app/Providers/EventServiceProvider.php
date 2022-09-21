<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],
        \App\Events\DepositCreated::class => [
            \App\Listeners\IncrementDepositBalanceAfterDepositCreated::class,
        ],
        \App\Events\WithdrawalCreated::class => [
            \App\Listeners\DecrementDepositBalanceAfterWithdrawalCreated::class,
        ],
        \App\Events\ClientCreated::class => [
            \App\Listeners\CreateDepositBalanceAfterClientCreated::class,
        ],
        \App\Events\LoanCreated::class => [
            \App\Listeners\CreateDebtAfterLoanCreated::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Deposit;
use App\Models\Loan;
use App\Models\Payment;
use App\Models\Withdrawal;
use App\Observers\ClientObserver;
use App\Observers\DepositObserver;
use App\Observers\LoanObserver;
use App\Observers\PaymentObserver;
use App\Observers\WithdrawalObserver;
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
            \App\Listeners\CreatePaymentOverdueAfterLoanCreated::class,
        ],
        \App\Events\PaymentCreated::class => [
            \App\Listeners\DecrementDebtAfterPaymentCreated::class,
            \App\Listeners\DeletePaymentOverdueAfterPaymentCreated::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Deposit::observe(DepositObserver::class);
        Client::observe(ClientObserver::class);
        Withdrawal::observe(WithdrawalObserver::class);
        Loan::observe(LoanObserver::class);
        Payment::observe(PaymentObserver::class);
    }
}

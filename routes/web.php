<?php

use App\Http\Controllers\ArearsController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\DepositBalanceController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/test', function () {
    return view('layouts.panel');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    // User
    Route::get('roles-search', [UserController::class, 'searchRoles']);
    Route::group(['middleware' => 'can:akses user'], function () {
        Route::get('user/get-list', [UserController::class, 'getUserList']);
        Route::resource('users', UserController::class)->except('destroy');
    });

    // Client
    Route::get('client/search', [ClientController::class, 'searchClient']);
    Route::group(['middleware' => 'can:akses klien'], function () {
        Route::get('client/get-list', [ClientController::class, 'getClientList']);
        Route::get('client/get-balance', [ClientController::class, 'getBalance']);
        Route::get('client/balance-check', [ClientController::class, 'balanceCheck']);
        Route::resource('clients', ClientController::class);
    });

    // Deposit
    Route::group(['middleware' => 'can:akses tabungan'], function () {
        //Deposit balance
        Route::get('deposit-balances', DepositBalanceController::class)->name('deposit.balances');

        //Deposit
        Route::resource('deposits', DepositController::class)->except('destroy');
        Route::get('deposit/get-list', [DepositController::class, 'getDepositList']);
        Route::get('deposit/deposit-type', [DepositController::class, 'getDepositType']);

        //Withdrawal
        Route::resource('withdrawals', WithdrawalController::class)->except('destroy');
        Route::get('withdrawal/get-list', [WithdrawalController::class, 'getWithdrawalList']);
    });

    // Loans
    Route::group(['middleware' => 'can:akses pinjaman'], function () {
        //Debt
        Route::get('debts', DebtController::class)->name('debts');

        //Loans
        Route::resource('loans', LoanController::class);
        Route::get('loan/get-list', [LoanController::class, 'getLoanList']);
        Route::get('loan/get-loan-by-client', [LoanController::class, 'getLoanByClient']);

        //Payment
        Route::resource('payments', PaymentController::class);
        Route::get('payment/get-list', [PaymentController::class, 'getPaymentList']);
        Route::get('payment/payment-check', [PaymentController::class, 'paymentCheck']);
        Route::get('payment/invoice/{payment}', [PaymentController::class, 'paymentInvoice'])->name('payments.invoice');
    });

    //Arrears
    Route::group(['middleware' => 'can:akses tunggakan'], function () {
        Route::get('arrears', [ArearsController::class, 'index'])->name('arrears.index');
        Route::get('arrears/{loan}', [ArearsController::class, 'show'])->name('arrears.show');
        Route::get('report-arrear-pdf', [ArearsController::class, 'arrearReportPdf'])->name('arrear.report');
    });

    //Report
    Route::group(['middleware' => 'can:akses laporan'], function () {
        Route::get('report-deposit', [ReportController::class, 'depositReport'])->name('deposit.report');
        Route::get('report-deposit-table', [ReportController::class, 'depositReportTable'])->name('deposit.report.table');
        Route::get('report-deposit-pdf', [ReportController::class, 'depositReportPdf']);

        Route::get('report-withdrawal', [ReportController::class, 'withdrawalReport'])->name('withdrawal.report');
        Route::get('report-withdrawal-table', [ReportController::class, 'withdrawalReportTable'])->name('withdrawal.report.table');
        Route::get('report-withdrawal-pdf', [ReportController::class, 'withdrawalReportPdf']);

        Route::get('report-loan', [ReportController::class, 'loanReport'])->name('loan.report');
        Route::get('report-loan-table', [ReportController::class, 'loanReportTable'])->name('loan.report.table');
        Route::get('report-loan-pdf', [ReportController::class, 'loanReportPdf']);

        Route::get('report-payment', [ReportController::class, 'paymentReport'])->name('payment.report');
        Route::get('report-payment-table', [ReportController::class, 'paymentReportTable'])->name('payment.report.table');
        Route::get('report-payment-pdf', [ReportController::class, 'paymentReportPdf']);
    });
});
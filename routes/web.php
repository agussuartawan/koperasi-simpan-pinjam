<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DepositBalanceController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    Route::group(['middleware' => 'can:akses klien'], function () {
        Route::get('client/get-list', [ClientController::class, 'getClientList']);
        Route::get('client/search', [ClientController::class, 'searchClient']);
        Route::resource('clients', ClientController::class);
    });

    // Deposit
    Route::group(['middleware' => 'can:akses tabungan'], function () {
        Route::get('deposit-balances', DepositBalanceController::class)->name('deposit.balances');
        Route::resource('deposits', DepositController::class)->except('destroy');
        Route::get('deposit/get-list', [DepositController::class, 'getDepositList']);
        Route::get('deposit/deposit-type', [DepositController::class, 'getDepositType']);
    });
});

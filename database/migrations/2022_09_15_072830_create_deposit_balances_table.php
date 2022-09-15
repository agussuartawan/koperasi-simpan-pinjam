<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onUpdate('cascade')->nullable();
            $table->foreignId('member_id')->constrained()->onUpdate('cascade')->nullable();
            $table->decimal('balance_amount', $precission = 18, $scale = 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposit_balances');
    }
}

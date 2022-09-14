<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onUpdate('cascade')->nullable();
            $table->foreignId('member_id')->constrained()->onUpdate('cascade')->nullable();
            $table->date('date');
            $table->string('withdrawal_type');
            $table->decimal('amount', $precission = 18, $scale = 2);
            $table->integer('bank_interest');
            $table->decimal('bank_interest_idr', $precission = 18, $scale = 2);
            $table->decimal('total_amount', $precission = 18, $scale = 2);
            $table->integer('term');
            $table->string('status');
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
        Schema::dropIfExists('withdrawals');
    }
}

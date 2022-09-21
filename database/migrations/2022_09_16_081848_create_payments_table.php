<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onUpdate('cascade');
            $table->foreignId('debt_id')->constrained()->onUpdate('cascade');
            $table->foreignId('loan_id')->constrained()->onUpdate('cascade');
            $table->string('code');
            $table->date('date');
            $table->integer('payment_on');
            $table->integer('mulct');
            $table->decimal('mulct_idr', $precission = 18, $scale = 2);
            $table->decimal('amount', $precission = 18, $scale = 2);
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
        Schema::dropIfExists('payments');
    }
}

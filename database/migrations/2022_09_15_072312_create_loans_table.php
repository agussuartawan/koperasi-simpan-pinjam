<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('client_id')->constrained()->onUpdate('cascade')->nullable();
            $table->foreignId('term')->constrained()->onUpdate('cascade')->nullable();
            $table->date('date');
            $table->decimal('amount', $precission = 18, $scale = 2);
            $table->integer('bank_interest');
            $table->decimal('bank_interest_idr', $precission = 18, $scale = 2);
            $table->decimal('total_amount', $precission = 18, $scale = 2);
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
        Schema::dropIfExists('loans');
    }
}

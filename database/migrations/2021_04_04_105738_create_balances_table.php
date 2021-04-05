<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_id')->unsigned();
            $table->decimal('op_debit',14,2)->default('0');
            $table->decimal('op_credit',14,2)->default('0');
            $table->decimal('t_debit',14,2)->default('0');
            $table->decimal('t_credit',14,2)->default('0');
            $table->decimal('cl_debit',14,2)->default('0');
            $table->decimal('cl_credit',14,2)->default('0');
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
        Schema::dropIfExists('balances');
    }
}

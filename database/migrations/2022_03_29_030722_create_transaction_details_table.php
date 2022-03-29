<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id('id_detail');
            $table->unsignedBigInteger('id_transaction');
            $table->unsignedBigInteger('id_menu');
            $table->integer('quantity');
            $table->integer('subtotal');
            $table->timestamps();

            $table->foreign('id_transaction')->references('id_transaction')->on('transactions');
            $table->foreign('id_menu')->references('id_menu')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_details');
    }
}

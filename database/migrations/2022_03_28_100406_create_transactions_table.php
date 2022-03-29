<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('id_transaction');
            $table->unsignedBigInteger('id_menu');
            $table->integer('quantity');
            $table->integer('subtotal');
            $table->string('table');
            $table->date('date');
            $table->string('status');
            $table->enum('payment', ['debbit', 'cash']);
            $table->timestamps();

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
        Schema::dropIfExists('transactions');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code' , 100);
            $table->string('productName');

            $table->integer('userID');
            $table->string('userCode')->nullable();

            $table->integer('quantity');
            $table->integer('totalPrice');
            $table->string('status' , 5)->default('BK');

            $table->dateTime('created_at')->nullable();
            $table->dateTime('checkin_at')->nullable();
            $table->dateTime('sale_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('booking');
    }
}

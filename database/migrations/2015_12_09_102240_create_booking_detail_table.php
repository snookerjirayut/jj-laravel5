<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookingDetail', function (Blueprint $table) {

            $table->increments('id');
            $table->string('code' , 100);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('checkin_at')->nullable();
            

            $table->integer('bookingID');
            $table->string('bookingCode')->nullable();

            $table->integer('zoneID');
            $table->string('zoneCode')->nullable();
            $table->integer('zoneNumber');

            $table->integer('price');
            $table->string('status' , 5)->default('BK');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bookingDetail');
    }
}

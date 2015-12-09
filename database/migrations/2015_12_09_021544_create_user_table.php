<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->integer('active')->default(1);
            $table->string('address')->nullable();
            $table->string('phone' , 10)->nullable();
            $table->string('cardID' , 13)->nullable();
            $table->integer('role');
            $table->string('image')->nullable();
            $table->string('favorite')->nullable();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}

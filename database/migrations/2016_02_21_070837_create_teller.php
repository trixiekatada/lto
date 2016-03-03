<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeller extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tellers', function (Blueprint $table) {
            $table->increments('teller_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('birth');
            $table->string('gender');
            $table->string('address');
            $table->string('mobile');
            $table->string('email')->unique();
            $table->string('password');
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
        Schema::drop('tbl_tellers');
    }
}

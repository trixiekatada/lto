<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_queue', function (Blueprint $table) {
            $table->increments('queue_id');
            $table->timestamps();
            $table->integer('transactionID_fk');
            $table->integer('processID_fk');
         //   $talbe->
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tbl_queue');
    }
}

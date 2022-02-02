<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('courier_id')->unsigned();
            $table->bigInteger('seller_id')->unsigned();
            $table->string('item_ref');
            $table->integer('trip_cash')->unsigned()->nullable();
            $table->integer('item_cash')->unsigned()->nullable();
            $table->boolean('status')->nullable();/* successed(1) || faild(0) */
            $table->boolean('situation')->default(false);/* successed(1) || faild(0) */
            $table->string('desc');
            $table->dateTime('ended_at')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('collected_at')->nullable();
            $table->dateTime('paid_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}

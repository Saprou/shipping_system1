<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('courier_id')->unsigned()->nullable();
            $table->bigInteger('holding_courier_id')->unsigned()->nullable();
            $table->bigInteger('location_id')->unsigned();
            $table->bigInteger('contact_id')->unsigned();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('hub');
            $table->string('awb')->unique();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('pickups');
    }
}

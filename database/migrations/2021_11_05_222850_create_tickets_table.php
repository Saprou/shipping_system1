<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('AWB');
            $table->string('agent_name');
            $table->string('agent_ref');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('subject')->nullable();
            $table->tinyInteger('area')->nullable();
            $table->tinyInteger('group')->nullable();
            $table->tinyInteger('account')->nullable();
            $table->string('mobile')->nullable();
            $table->string('description');
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
        Schema::dropIfExists('tickets');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('f_name');
            $table->string('l_name');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('sec_mobile')->unique()->nullable();
            $table->string('role')->default('seller');
            $table->string('payment_method')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('ref')->unique();
            $table->string('heard_from')->default('none');


            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}

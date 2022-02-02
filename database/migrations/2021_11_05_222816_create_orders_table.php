<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('courier_id')->unsigned()->nullable();
            $table->bigInteger('holding_courier_id')->unsigned()->nullable();
            $table->string('order_awb')->nullable();
            $table->tinyInteger('status')->default(1);
                        /* ORDER DETAILS */
            $table->bigInteger('pickup_id')->unsigned()->nullable();                
            $table->tinyInteger('type')->nullable();
            $table->tinyInteger('package_type')->nullable();
            $table->tinyInteger('attempts')->default(0);
            $table->integer('total_cash')->nullable();             /* cash on deliver */
            $table->integer('number_of_items')->nullable();;/* number of items to deliver */
            $table->string('desc')->nullable();
            $table->string('awb')->unique();
                /* order reference && serial number */
                    /* CUSTOMER DETAILS */
            $table->string('name');
            $table->string('mobile');
            $table->string('sec_mobile')->nullable();
            $table->string('notes')->nullable();
                    /* location */
            $table->string('city');
            $table->string('area');
            $table->string('street');
            $table->string('landmarks');
            $table->string('building')->nullable();
            $table->string('floor')->nullable();
            $table->string('apartment')->nullable();
                    /* TIMING DETAILS */
            $table->date('deliverd_at')->nullable();
            $table->date('paid_at')->nullable();
            $table->date('collected_at')->nullable();
            $table->date('received_at')->nullable();
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
        Schema::dropIfExists('orders');
    }
}

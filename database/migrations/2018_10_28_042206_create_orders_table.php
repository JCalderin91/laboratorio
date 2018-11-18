<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('client_id',8);
            $table->string('user_id',8);
            $table->unsignedInteger('device_id');

            $table->dateTime('arrival_date');
            $table->dateTime('delivery_date')->nullable();
            $table->string('description')->nullable();
            $table->enum('status', ['PENDING', 'REVISED', 'DELIVERED'])->default('ACTIVE');
            
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('device_id')->references('id')->on('devices');
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

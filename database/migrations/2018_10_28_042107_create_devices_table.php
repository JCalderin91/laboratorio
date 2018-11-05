<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sub_device_id');
            $table->unsignedInteger('brand_id');
            $table->string('client_id',8);

            $table->string('b_n')->nullable();
            $table->string('model')->nullable();
            $table->timestamps();

            $table->foreign('sub_device_id')->references('id')->on('sub_devices');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}

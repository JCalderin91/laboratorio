<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('area_id');
            $table->unsignedInteger('address_id');

            $table->string('ci',8)->unique();
            $table->string('first_name',128);
            $table->string('last_name',128);
            $table->string('phone')->nullable();
            $table->timestamps();
            $table->softDeletes();   

            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('address_id')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}

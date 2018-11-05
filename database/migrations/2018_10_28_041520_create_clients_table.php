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
            $table->string('id',8);
            $table->unsignedInteger('area_id');

            $table->string('first_name',128);
            $table->string('last_name',128);
            $table->string('phone');
            $table->enum('status', ['ACTIVE', 'INACTIVE']);
            $table->timestamps();

            $table->primary('id');
            $table->foreign('area_id')->references('id')->on('areas');
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

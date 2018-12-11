<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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

            $table->increments('id');

            $table->string('ci',8)->unique();
            $table->string('first_name',128);
            $table->string('last_name',128);
            $table->enum('gender', ['F', 'M']);
            $table->string('password');
            $table->string('admin')->default(User::USER_REGULAR);
            $table->timestamps(); 
            $table->softDeletes();   
            
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

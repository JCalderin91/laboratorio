<?php
use App\Order;
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
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('device_id');
            $table->unsignedInteger('user_id');

            $table->dateTime('arrival_date');
            $table->string('description')->nullable();
            $table->enum('status', [Order::ORDER_PENDING, Order::ORDER_REVISED, Order::ORDER_DELIVERED ])->default(Order::ORDER_PENDING);
            $table->softDeletes();   

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

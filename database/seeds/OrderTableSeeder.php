<?php

use Illuminate\Database\Seeder;
use App\Order;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = new Order();
        $order->user_id = 1;
        $order->device_id = 1;
        $order->client_id = 1;
        $order->arrival_date = new \DateTime('2018-10-25 11:10:15'); 
        $order->status = Order::ORDER_PENDING;
        $order->save();

        $order = new Order();
        $order->user_id = 1;
        $order->device_id = 4;
        $order->client_id = 1;
        $order->arrival_date = new \DateTime('2018-09-25 11:10:15'); 
        $order->status = Order::ORDER_DELIVERED;
        $order->save();

        $order = new Order();
        $order->user_id = 2;
        $order->device_id = 2;
        $order->client_id = 2;
        $order->arrival_date = new \DateTime('2018-10-28 11:10:15'); 
        $order->status = Order::ORDER_PENDING;
        $order->save();

        $order = new Order();
        $order->user_id = 1;
        $order->device_id = 3;
        $order->client_id = 3;
        $order->arrival_date = new \DateTime('2018-09-20 11:10:15'); 
        $order->status = Order::ORDER_REVISED;
        $order->save();

        $order = new Order();
        $order->user_id = 1;
        $order->device_id = 3;
        $order->client_id = 3;
        $order->arrival_date = new \DateTime('2018-09-20 11:10:15'); 
        $order->status = Order::ORDER_PENDING;
        $order->save();

        $order = new Order();
        $order->user_id = 2;
        $order->device_id = 3;
        $order->client_id = 3;
        $order->arrival_date = new \DateTime('2018-09-20 11:10:15'); 
        $order->status = Order::ORDER_REVISED;
        $order->save();

        $order = new Order();
        $order->user_id = 2;
        $order->device_id = 3;
        $order->client_id = 3;
        $order->arrival_date = new \DateTime('2018-09-20 11:10:15'); 
        $order->status = Order::ORDER_REVISED;
        $order->save();

        $order = new Order();
        $order->user_id = 3;
        $order->device_id = 3;
        $order->client_id = 2;
        $order->arrival_date = new \DateTime('2018-09-20 11:10:15'); 
        $order->status = Order::ORDER_PENDING;
        $order->save();
    }
}

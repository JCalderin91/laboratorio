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
        $order->serial = '2510201817';
        $order->arrival_date = new \DateTime('2018-10-25 11:10:15'); 
        $order->status = Order::ORDER_PENDING;
        $order->save();

        $order = new Order();
        $order->user_id = 1;
        $order->device_id = 4;
        $order->client_id = 1;
        $order->serial = '2509201816';
        $order->arrival_date = new \DateTime('2018-09-25 11:10:15'); 
        $order->status = Order::ORDER_DELIVERED;
        $order->save();

        $order = new Order();
        $order->user_id = 2;
        $order->device_id = 2;
        $order->client_id = 2;
        $order->serial = '2510201818';
        $order->arrival_date = new \DateTime('2018-10-28 11:10:15'); 
        $order->status = Order::ORDER_PENDING;
        $order->save();

        $order = new Order();
        $order->user_id = 1;
        $order->device_id = 3;
        $order->client_id = 3;
        $order->serial = '200920181';
        $order->arrival_date = new \DateTime('2018-09-20 11:10:15'); 
        $order->status = Order::ORDER_REVISED;
        $order->save();

        $order = new Order();
        $order->user_id = 1;
        $order->device_id = 3;
        $order->client_id = 3;
        $order->serial = '200920182';
        $order->arrival_date = new \DateTime('2018-09-20 11:10:15'); 
        $order->status = Order::ORDER_PENDING;
        $order->save();

        $order = new Order();
        $order->user_id = 2;
        $order->device_id = 3;
        $order->client_id = 3;
        $order->serial = '200920183';
        $order->arrival_date = new \DateTime('2018-09-20 11:10:15'); 
        $order->status = Order::ORDER_REVISED;
        $order->save();

        $order = new Order();
        $order->user_id = 2;
        $order->device_id = 3;
        $order->client_id = 3;
        $order->serial = '200920184';
        $order->arrival_date = new \DateTime('2018-09-20 11:10:15'); 
        $order->status = Order::ORDER_REVISED;
        $order->save();

        $order = new Order();
        $order->user_id = 3;
        $order->device_id = 3;
        $order->client_id = 2;
        $order->serial = '200920185';
        $order->arrival_date = new \DateTime('2018-09-20 11:10:15'); 
        $order->status = Order::ORDER_PENDING;
        $order->save();

        $order = new Order();
        $order->user_id = 3;
        $order->device_id = 3;
        $order->client_id = 2;
        $order->serial = '200920186';
        $order->arrival_date = new \DateTime('2018-09-20 11:11:15'); 
        $order->status = Order::ORDER_PENDING;
        $order->save();

        $order = new Order();
        $order->user_id = 3;
        $order->device_id = 3;
        $order->client_id = 2;
        $order->serial = '200920187';
        $order->arrival_date = new \DateTime('2018-09-20 11:20:15'); 
        $order->status = Order::ORDER_PENDING;
        $order->save();

        $order = new Order();
        $order->user_id = 3;
        $order->device_id = 3;
        $order->client_id = 2;
        $order->serial = '200920188';
        $order->arrival_date = new \DateTime('2018-09-20 11:30:15'); 
        $order->status = Order::ORDER_PENDING;
        $order->save();

        $order = new Order();
        $order->user_id = 3;
        $order->device_id = 3;
        $order->client_id = 2;
        $order->serial = '200920189';
        $order->arrival_date = new \DateTime('2018-09-20 11:40:15'); 
        $order->status = Order::ORDER_PENDING;
        $order->save();

        $order = new Order();
        $order->user_id = 3;
        $order->device_id = 3;
        $order->client_id = 2;
        $order->serial = '2009201810';
        $order->arrival_date = new \DateTime('2018-09-20 11:50:15'); 
        $order->status = Order::ORDER_PENDING;
        $order->save();

        $order = new Order();
        $order->user_id = 3;
        $order->device_id = 3;
        $order->client_id = 2;
        $order->serial = '2009201811';
        $order->arrival_date = new \DateTime('2018-09-20 12:00:15'); 
        $order->status = Order::ORDER_PENDING;
        $order->save();

        $order = new Order();
        $order->user_id = 3;
        $order->device_id = 3;
        $order->serial = '2009201812';
        $order->client_id = 2;
        $order->arrival_date = new \DateTime('2018-09-20 12:10:15'); 
        $order->status = Order::ORDER_PENDING;
        $order->save();

        $order = new Order();
        $order->user_id = 3;
        $order->device_id = 3;
        $order->client_id = 2;
        $order->serial = '2009201813';
        $order->arrival_date = new \DateTime('2018-09-20 12:20:15'); 
        $order->status = Order::ORDER_PENDING;
        $order->save();

        $order = new Order();
        $order->user_id = 3;
        $order->device_id = 3;
        $order->client_id = 2;
        $order->serial = '2009201814';
        $order->arrival_date = new \DateTime('2018-09-20 12:30:15'); 
        $order->status = Order::ORDER_PENDING;
        $order->save();

        $order = new Order();
        $order->user_id = 3;
        $order->device_id = 3;
        $order->client_id = 2;
        $order->serial = '2009201815';
        $order->arrival_date = new \DateTime('2018-09-20 12:40:15'); 
        $order->status = Order::ORDER_PENDING;
        $order->save();
    }
}

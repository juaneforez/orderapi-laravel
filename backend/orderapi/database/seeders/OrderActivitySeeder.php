<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $order = Order::find(1);
        $activity = Activity::find(1);
        $order->activities()->attach($activity->id);

        $activity = Activity::find(2);
        $order->activities()->attach($activity->id);
    }
}

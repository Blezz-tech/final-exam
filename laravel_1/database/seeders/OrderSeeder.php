<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            // Создаем 5 заказов для каждого пользователя
            for ($i = 0; $i < 5; $i++) {
                $order = Order::factory()->create([
                    'user_id' => $user->id,
                ]);

                // Создаем от 3 до 5 позиций заказа
                $orderItemsCount = rand(3, 5);
                for ($j = 0; $j < $orderItemsCount; $j++) {
                    OrderItem::factory()->create(['order_id' => $order->id,]);
                }
            }
        }
    }
}

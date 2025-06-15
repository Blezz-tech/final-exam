<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // admin для удобства
        User::factory()->create([
            'login' => 'admin1',
            'email' => 'admin1@admin.admin',
            'password' =>  bcrypt('123'),
            'is_admin' => 1,
        ]);

        // admin по заданию !!! Важно, чтобы всё совпадало с заданием
        User::factory()->create([
            'login' => 'help',
            'email' => 'admin@admin.admin',
            'password' =>  bcrypt('helpme'),
            'is_admin' => 1,
        ]);

        // Создаём пользователя, которого будем тестировать
        $user = User::factory()->create([
            'login' => 'user',
            'email' => 'user@user.user',
            'password' =>  bcrypt('123'),
        ]);

        // Создаём ещё 10 случный пользователей
        User::factory()->count(10)->create([
            'password' => bcrypt('123'),
        ]);
    }
}

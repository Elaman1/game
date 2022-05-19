<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Provider\Lorem;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'test',
            'email' => 'test@mail.ru',
            'password' => Hash::make('password'),
            'money' => 20000000,
            'energy' => 100,
            'health' => 100,
            'happy' => 100,
            'impact' => 0,
            'popularity' => 0,
        ]);

        DB::table('spendings')->insert([
            'user_id' => 1,
            'home_id' => 1,
            'transport_id' => 1,
        ]);

        DB::table('user_work')->insert([
            'user_id' => 1,
            'work_id' => 1
        ]);
        DB::table('step_information')->insert([
            'day' => 0,
            'day_tragedy' => 10
        ]);

        DB::table('any_info')->insert(
            [
                [
                    'key' => 'energy_for_work',
                    'value' => 40
                ],
                [
                    'key' => 'get_energy_servant',
                    'value' => 15
                ],
                [
                    'key' => 'get_energy_car',
                    'value' => 10
                ]
            ]
        );

        DB::table('spending_home')->insert([
            [
                'price' => 15000,
                'communal' => 100,
                'image' => 'home_spending_1.jpg',
                'happy_home' => 1
            ],
            [
                'price' => 85000,
                'communal' => 105,
                'image' => 'home_spending_2.jpg',
                'happy_home' => 2
            ],
            [
                'price' => 250000,
                'communal' => 250,
                'image' => 'home_spending_3.jpg',
                'happy_home' => 5
            ],
            [
                'price' => 250000,
                'communal' => 250,
                'image' => 'home_spending_4.jpg',
                'happy_home' => 7,
            ],
            [
                'price' => 1200000,
                'communal' => 1000,
                'image' => 'home_spending_5.jpg',
                'happy_home' => 11
            ],
            [
                'price' => 45000000,
                'communal' => 1500,
                'image' => 'home_spending_6.jpg',
                'happy_home' => 13
            ],
            [
                'price' => 90000000,
                'communal' => 2500,
                'image' => 'home_spending_7.jpg',
                'happy_home' => 17
            ],
            [
                'price' => 120000000,
                'communal' => 3750,
                'image' => 'home_spending_8.jpg',
                'happy_home' => 20
            ],
            [
                'price' => 400000000,
                'communal' => 7500,
                'image' => 'home_spending_9.jpg',
                'happy_home' => 23
            ],
            [
                'price' => 800000000,
                'communal' => 15000,
                'image' => 'home_spending_10.jpg',
                'happy_home' => 25
            ]

        ]);

        DB::table('spending_transport')->insert([
            [
                'price' => 2000,
                'communal' => 100,
                'image' => 'car_spending_1.jpg',
                'happy_car' => 1
            ],
            [
                'price' => 9800,
                'communal' => 150,
                'image' => 'car_spending_2.jpg',
                'happy_car' => 3
            ],
            [
                'price' => 14000,
                'communal' => 180,
                'image' => 'car_spending_3.jpg',
                'happy_car' => 6
            ],
            [
                'price' => 45000,
                'communal' => 350,
                'image' => 'car_spending_4.jpg',
                'happy_car' => 12
            ],
            [
                'price' => 75000,
                'communal' => 500,
                'image' => 'car_spending_5.jpg',
                'happy_car' => 15
            ],
            [
                'price' => 95000,
                'communal' => 650,
                'image' => 'car_spending_6.jpg',
                'happy_car' => 18
            ],
            [
                'price' => 450000,
                'communal' => 2500,
                'image' => 'car_spending_7.jpg',
                'happy_car' => 20
            ],
            [
                'price' => 1200000,
                'communal' => 4000,
                'image' => 'car_spending_8.jpg',
                'happy_car' => 23
            ],
            [
                'price' => 5200000,
                'communal' => 6500,
                'image' => 'car_spending_9.jpg',
                'happy_car' => 25
            ],
            [
                'price' => 10000000,
                'communal' => 11500,
                'image' => 'car_spending_10.jpg',
                'happy_car' => 30
            ],
        ]);

        DB::table('spending_food')->insert([
            [
                'price' => 0,
                'communal' => 400,
                'title' => "Полуфабрикаты",
                'health_food' => 3
            ],
            [
                'price' => 0,
                'communal' => 700,
                'title' => "Фастфуд",
                'health_food' => 6
            ],
            [
                'price' => 0,
                'communal' => 1800,
                'title' => "Дешевый ресторан",
                'health_food' => 8
            ],
            [
                'price' => 0,
                'communal' => 5000,
                'title' => "Дорогой ресторан",
                'health_food' => 12
            ],
        ]);

        DB::table('works')->insert([
            [
                'post' => "Стажер",
                'salary' => 410
            ],
            [
                'post' => "Работник",
                'salary' => 800,
            ],
            [
                'post' => "Опытный работник",
                'salary' => 1400,
            ],
            [
                'post' => "Старший работник",
                'salary' => 3000,
            ],
            [
                'post' => "Руководитель",
                'salary' => 6000,
            ],
            [
                'post' => "Директор",
                'salary' => 9000,
            ],
        ]);


        DB::table('age_user')->insert([
            [
                'min_age' => 18,
                'max_age' => 21,
                'want_happy' => 0,
                'want_health' => 0
            ],
            [
                'min_age' => 22,
                'max_age' => 30,
                'want_happy' => 5,
                'want_health' => 3
            ],
            [
                'min_age' => 31,
                'max_age' => 40,
                'want_happy' => 15,
                'want_health' => 6
            ],
            [
                'min_age' => 41,
                'max_age' => 50,
                'want_happy' => 30,
                'want_health' => 9
            ],
            [
                'min_age' => 51,
                'max_age' => 60,
                'want_happy' => 60,
                'want_health' => 12
            ]
        ]);
    }
}

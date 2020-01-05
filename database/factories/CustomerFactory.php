<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'customer_id' => rand(1, 1000),
        'name' => $faker->name,
        'meeting_preferencies' => [
            [
                'week_day' => rand(1, 7),
                'time' => \Carbon\Carbon::now()->format('H:i:s')
            ],
            [
                'week_day' => rand(1, 7),
                'time' => \Carbon\Carbon::now()->format('H:i:s')
            ]
        ]
    ];
});

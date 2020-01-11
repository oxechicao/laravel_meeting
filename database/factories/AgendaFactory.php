<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Agenda;
use Faker\Generator as Faker;

$factory->define(Agenda::class, function (Faker $faker) {
    return [
        'title' => $faker->text(100),
        'description' => $faker->realText(),
        'participants' => [$faker->unique()->safeEmail, $faker->unique()->safeEmail, $faker->unique()->safeEmail],
        'date' => $faker->dateTime,
        'hour' => $faker->time(),
        'user_id' => $faker->numberBetween(1, 10)
    ];
});

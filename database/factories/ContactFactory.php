<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'name' => $faker->name . $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phones' => [$faker->phoneNumber],
        'user_id' => $faker->numberBetween(1, 10)
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Booking;
use Faker\Generator as Faker;

$factory->define(Booking::class, function (Faker $faker) {
    return [
        'customer_id' => 3,
        'vehicle'     => $faker->randomElement(['motorcycle', 'car']),
        'service'     => $faker->randomElement(['pabili', 'padala', 'pa-grocery']),
        'status'      => 'pending',
        'schedule'    => $faker->dateTime,
        'pick_up'     => $faker->address,
        'drop_off'    => $faker->address,
        'amount'      => 300,
    ];
});

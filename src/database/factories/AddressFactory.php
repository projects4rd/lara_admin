<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'street' => $faker->streetName,
        'number' => rand(1, 30),
        'postcode' => $faker->postcode,
        'city' => $faker->city,
        'country' => $faker->country,
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name'  => $faker->lastName,
        'email'      => $faker->email,
        'phone'      => $faker->e164PhoneNumber,
        'mobile'     => $faker->e164PhoneNumber,
        'bio'        => $faker->text(rand(250, 300)),
        'salutation' => $faker->title,
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Lead;
use Faker\Generator as Faker;

$factory->define(Lead::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'company' => $faker->company,
        'country' => $faker->country,
        'title' => $faker->jobTitle,
        'email' => $faker->companyEmail,
        'phone' => $faker->e164PhoneNumber,
        'linkedin' => $faker->url
    ];
});

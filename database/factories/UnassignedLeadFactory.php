<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Lead;
use Faker\Generator as Faker;

$factory->define(Lead::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'company_id' => rand(0, 5000),
        'country' => $faker->country,
        'title' => $faker->jobTitle,
        'email' => $faker->companyEmail,
        'phone_1' => $faker->e164PhoneNumber,
        'linkedin' => $faker->url,
        'user_id' => rand(0, 2),
        'unassigned' => true
    ];
});

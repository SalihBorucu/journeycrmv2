<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Lead;
use App\User;
use App\GlobalLeadNotes;
use Faker\Generator as Faker;

$factory->define(GlobalLeadNotes::class, function (Faker $faker) {
    $leads = Lead::pluck('id')->toArray();
    $users = User::pluck('id')->toArray();

    return [
            'lead_id' => $leads[array_rand($leads, 1)],
            'user_id' => $users[array_rand($users, 1)],
            'note' => $faker->realText($maxNbChars = 200, $indexSize = 2),
            'score' => rand(1, 10)
    ];
});

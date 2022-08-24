<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Login;
use Faker\Generator as Faker;

$factory->define(Login::class, function (Faker $faker) {
    return [
        'ip_address' => $faker->ipv4,
        'created_at' => $faker->dateTimeThisDecade('now'),
    ];
});

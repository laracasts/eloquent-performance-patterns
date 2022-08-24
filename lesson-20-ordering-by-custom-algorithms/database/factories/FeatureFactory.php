<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Feature;
use Faker\Generator as Faker;

$factory->define(Feature::class, function (Faker $faker) {
    $title = $faker->randomElement(['Add', 'Fix', 'Improve']).' '.implode(' ', $faker->words(rand(2, 5)));

    return [
        'title' => $title,
        'status' => $faker->randomElement([
            'Requested',
            'Requested',
            'Requested',
            'Requested',
            'Requested',
            'Requested',
            'Requested',
            'Requested',
            'Requested',
            'Approved',
            'Completed',
            'Completed',
        ]),
    ];
});

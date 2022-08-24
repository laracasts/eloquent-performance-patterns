<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $title = substr($faker->sentence(), 0, -1);

    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'body' => $faker->paragraphs(500, true),
        'published_at' => $faker->dateTimeThisDecade(),
    ];
});

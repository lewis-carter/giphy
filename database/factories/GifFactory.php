<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Gif;
use Faker\Generator as Faker;

$factory->define(Gif::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'url' => $faker->imageUrl()
    ];
});

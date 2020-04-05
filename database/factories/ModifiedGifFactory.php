<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\ModifiedGif;
use Faker\Generator as Faker;

$factory->define(ModifiedGif::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'url' => $faker->imageUrl(),
    ];
});

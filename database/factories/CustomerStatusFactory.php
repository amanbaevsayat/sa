<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CustomerStatus;
use Faker\Generator as Faker;

$factory->define(CustomerStatus::class, function (Faker $faker) {
    return [
        'title' => $faker->word
    ];
});

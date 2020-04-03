<?php

/** @var Factory $factory */

use App\Models\CarMake;
use Faker\Generator as Faker;
use Faker\Provider\Fakecar;
use Illuminate\Database\Eloquent\Factory;

$factory->define(CarMake::class, function (Faker $faker) {
    $faker->addProvider(new Fakecar($faker));

    return [
        'name' => $faker->unique()->vehicleBrand,
    ];
});

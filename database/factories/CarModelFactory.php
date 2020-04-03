<?php

/** @var Factory $factory */

use App\Models\CarMake;
use App\Models\CarModel;
use Faker\Generator as Faker;
use Faker\Provider\Fakecar;
use Illuminate\Database\Eloquent\Factory;

$factory->define(CarModel::class, function (Faker $faker) {
    $faker->addProvider(new Fakecar($faker));
    return [
        'name' => $faker->unique()->vehicleModel,
        'make_id' => CarMake::query()->pluck('id')->random(),
    ];
});

<?php

/** @var Factory $factory */

use App\Models\Car;
use App\Models\CarMake;
use App\Models\CarModel;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Car::class, function (Faker $faker) {
    $models = CarModel::query()->pluck('id', 'make_id')->toArray();
    $key = array_rand($models);

    return [
        'make_id' => $key,
        'model_id' => $models[$key],
        'year' => $faker->year,
        'mileage' => $faker->randomNumber(6),
        'color' => $faker->colorName,
        'price' => $faker->randomFloat(2, 100, 150000)
    ];
});

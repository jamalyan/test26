<?php

/** @var Factory $factory */

use App\Models\Car;
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
        'mileage' => $faker->randomFloat(2, 1000, 990000),
        'color' => $faker->colorName,
        'price' => $faker->randomFloat(2, 100, 150000)
    ];
});

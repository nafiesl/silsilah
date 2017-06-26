<?php

use App\User;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'nickname' => $faker->name,
        'gender_id' => rand(1, 2),
    ];
});

$factory->state(User::class, 'male', function (Faker\Generator $faker) {
    return ['gender_id' => 1];
});

$factory->state(User::class, 'female', function (Faker\Generator $faker) {
    return ['gender_id' => 2];
});
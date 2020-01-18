<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Client::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'cif' => $faker->dni,
        'direccion' => $faker->address,
        'telefono' => $faker->mobileNumber,
        'email' => $faker->unique()->safeEmail,
    ];
});

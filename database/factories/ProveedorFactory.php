<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Proveedor;
use Faker\Generator as Faker;

$factory->define(Proveedor::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'cif' => $faker->dni,
        'direccion' => $faker->address,
        'telefono' => $faker->mobileNumber,
        'email' => $faker->unique()->safeEmail,
        'comentario'=> $faker->sentence(8),
    ];
});

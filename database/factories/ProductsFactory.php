<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\products;
use Faker\Generator as Faker;

$factory->define(products::class, function (Faker $faker) {
    return [
        'name'=>$faker->company,
        'precio'=>$faker->randomFloat($nbMaxDecimals = null, $min = 1, $max = 999),
        'descripcion'=>$faker->word,
        'user_id'=> App\User::all()->random()->id,
    ];

});

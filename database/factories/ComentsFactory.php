<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\coments;
use Faker\Generator as Faker;

$factory->define(coments::class, function (Faker $faker) {
    return [
        'mensaje'=>$faker->sentence($nbWords=6,$variableNbWords=true),
        'product_id'=> App\products::all()->random()->id,
        'user_id'=> App\User::all()->random()->id,
    ];
});

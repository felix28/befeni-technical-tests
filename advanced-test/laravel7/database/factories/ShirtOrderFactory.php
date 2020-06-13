<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ShirtOrder;
use Faker\Generator as Faker;

$factory->define(ShirtOrder::class, function (Faker $faker) {
    return [
        'customer_id' => $faker->numberBetween(1, 1000), 
	    'fabric_id'   => $faker->numberBetween(1, 1000),
	    'collar_size' => $faker->numberBetween(1, 1000), 
	    'chest_size'  => $faker->numberBetween(1, 1000), 
	    'waist_size'  => $faker->numberBetween(1, 1000), 
	    'wrist_size'  => $faker->numberBetween(1, 1000)
    ];
});

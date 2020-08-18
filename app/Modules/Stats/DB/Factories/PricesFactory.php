<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Modules\Stats\Models\Products\Prices;
use Faker\Generator as Faker;

$faker = new Faker();
$factory->define(Prices::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTimeBetween('-30 days')->format('Y-m-d'),
        'creator' =>  $faker->numberBetween(1,10),
        'product_id' => $faker->numberBetween(1,5),
        'price_uah' => $faker->numberBetween(50,25000),
        'price_usd' =>  $faker->numberBetween(2,10000),
        'price_eur' =>  $faker->numberBetween(1,5000),
        'price_bitcoin' => $faker->numberBetween(0,500),
        'source' => $faker->url
    ];
});

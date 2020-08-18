<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Modules\Stats\Models\Products\Prices;
use Faker\Generator as Faker;

$faker = new Faker();
$factory->define(\App\Modules\Stats\Models\Regions\Peoples::class, function (Faker $faker) {

    $count = $faker->numberBetween(10000,50000);
    $males = $count - $faker->numberBetween($count*0.4,$count);
    $females = $count - $males;
    $short = $count - $faker->numberBetween($count*0.5,$count);
    $tall = $count - $short;
    return [
        'date' => $faker->dateTimeBetween('-30 days')->format('Y-m-d'),
        'creator' =>  $faker->numberBetween(1,10),
        'region_id' => $faker->numberBetween(1,15),
        'count' => $count,
        'males' => $males,
        'females' =>  $females,
        'short' => $short,
        'tall' => $tall,
        'source' => $faker->url
    ];
});

<?php

use Faker\Generator as Faker;

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

$factory->define(App\Bank::class, function (Faker $faker) {

    $realms = ['Draenor','Frostwhisper','Kazzak','Ragnaros','Stormscale','Stormreaver','Tarren Mill',
               'Chromaggus','Shattered Halls','Boulderfist'];
    $regions = ['EN','FR','DE','ES','RU','IT'];


    return [
        'name'    => $faker->unique()->randomElement($realms),
        'faction' => $faker->optional($weight = 0.90, $default = 'H')->randomElement($array = array ('H','A')),
        'region'  => $faker->randomElement($regions),
        'balance' => $faker->numberBetween($min = 1, $max = 9999999),
    ];
});

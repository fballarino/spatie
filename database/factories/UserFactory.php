<?php

use Faker\Generator as Faker;
use App\Bank;
use App\User;

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

$factory->define(App\Transaction::class, function (Faker $faker) {

    $operations = [
        1 => '(001) Collector Deposit',
        2 => '(002) Withdrawal',
        3 => '(003) Booster Payment',
        4 => '(004) Token Purchase',
    ];

    return [
        'bank_id'      => Bank::inRandomOrder()->first()->id,
        'user_id'      => User::inRandomOrder()->first()->id,
        'operation'    => $faker->randomElement($operations),
        'amount'       => $faker->numberBetween($min = -3000, $max = 3000)*1000,
        'created_at'   => $faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Paris'),
        'operator_id'  => User::find(1)->id,
    ];
});

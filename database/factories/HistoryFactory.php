<?php

use Faker\Generator as Faker;
//use GuzzleHttp\Client;

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


$factory->define(App\Models\History::class, function (Faker $faker) {

//    $client = new Client();
//    $ip = $faker->ipv4;
//    $res = $client->get('http://ip-api.com/json/'.$ip);
//    $clientInfo = $res->getBody();

    return [
        'name' => $faker->name,
        'ip_address' => $faker->ipv4,
        'type' => $faker->randomElement(['byLink', '#personTab', 'search_#personTab', '#departmentTab', 'search_#departmentTab']),
//        'country_name' => $clientInfo->country,
//        'country_code' => $clientInfo->countryCode,
//        'state' => $clientInfo->regionName

    ];
});

<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'mailtrap' => [
        "driver" => "smtp",
        "host" => "smtp.mailtrap.io",
        "port" => 2525,
        "from" => [
            "address" => "contacts@scholarmetrics.com",
            "name" => "Mail from scholarmetrics.com"
        ],
        "username" => "41f692da456da4",
        "password" => "a76111f38033de",
        "sendmail" => "/usr/sbin/sendmail -bs",
        "pretend" => false
    ],

];

<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'ihio' => [
        'username' => env('IHIO_USERNAME'),
        'password' => env('IHIO_PASSWORD'),
        'terminalId' => env('IHIO_TERMINAL_ID'),
        'testMode' => env('IHIO_TEST_MODE', false),
        // 'storage' => \App\Domains\Prescription\ExternalServices\Ihio\Storage\RedisStore::class,
        'storage' => \App\Domains\Prescription\ExternalServices\Ihio\Storage\FileStore::class,
        'filePath' => 'secrets/ihio.json', // path in storage directory
    ],

    'rahyab' => [
        'username' => env('RAHYAB_USERNAME'),
        'password' => env('RAHYAB_PASSWORD'),
        'company' => env('RAHYAB_COMPANY'),
        'host' => env('RAHYAB_HOST'),
        'port' => env('RAHYAB_PORT'),
    ],

];

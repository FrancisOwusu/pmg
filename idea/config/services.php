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

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'paystack' => [
        'enabled' => env('PAYSTACK_ENABLED'),
        'status'=>env('PAYSTACK_STATUS'),
        'subscription_enable' => env('PAYSTACK_SUBSCRIPTION_ENABLED'),
        'base_uri' => env('PAYSTACK_BASE_URI'),
        'webhook_uri' => env('PAYSTACK_WEBHOOK_URI'),
        'api_public_key' => env('PAYSTACK_PUBLIC_KEY'),
        'api_secrete_key_live' => env('PAYSTACK_SECRET_LIVE'),
        'api_secrete_key_test' => env('PAYSTACK_SECRET_TEST'),
        'class' => \App\Services\PayStack\PayStackServiceImpl::class,
    ],

];

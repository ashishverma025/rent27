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
     
   
   
    'google' => [
        'client_id' => '959708623775-78ulsh4m2f3apebklokofjj6qiuvsj57.apps.googleusercontent.com',
        'client_secret' => 'ZWZn--l43mjwKfH9eMe61f6z',
        'redirect' => 'https://emptytruck100.com/auth/google/callback',
    ],

   
    
    // 'google' => [
    //     'client_id'     => '451787054448-i4a3k3l1fupi671juqbqllojjmgk7fms.apps.googleusercontent.com',
    //     'client_secret' => 'bJ75KrgERfu48bvPRKjIztU8',
    //     'redirect'      => 'http://tutify.com.sg/google-callback'
    // ],

  'facebook' => [
    'client_id' => env('FACEBOOK_CLIENT_ID'),
    'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
    'redirect' => env('CALLBACK_URL'),
 ],
'twitter' => [
     'client_id' => '5Ksc44Aq3sXL3tL86UNk0CbMc',
     'client_secret' => 'SEDm9vlhPr8vMy8zLiE1ImfBjvUobQOSc4Q5yCtpAUdbmKm2mR',
     'redirect' => 'https://emptytruck100.com/auth/twitter/callback',
 ],
];

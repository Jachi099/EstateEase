<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
    'guard' => 'web', // You can set the default guard to 'tenant' or another type based on your needs
    'passwords' => 'users', // Update if you have different password reset configurations
],

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users', // This can be your visitors
    ],
    'landlord' => [
        'driver' => 'session',
        'provider' => 'landlords',
    ],
    'tenant' => [
        'driver' => 'session',
        'provider' => 'tenants',
    ],
],

'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class, // Model for visitors
    ],
    'landlords' => [
        'driver' => 'eloquent',
        'model' => App\Models\Landlord::class, // Create this model for landlords
    ],
    'tenants' => [
        'driver' => 'eloquent',
        'model' => App\Models\Tenant::class, // Tenant model created earlier
    ],
],



    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];

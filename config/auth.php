<?php

return [
    'defaults' => [
        'guard' => 'web', // Default guard for users
        'passwords' => 'users',
    ],

    'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
        'session' => 'web_auth_session', // Unique session key for users
    ],

    'admin' => [
        'driver' => 'session',
        'provider' => 'users', // Admins and users share the same provider (User model)
        'session' => 'admin_auth_session', // Unique session key for admins
    ],

    'cashier' => [
        'driver' => 'session',
        'provider' => 'users',
        'session' => 'cashier_auth_session',
    ],
],


    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];


<?php

/**
 * PayPal Setting & API Credentials
 *
 */

 return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'),

    'sandbox' => [
        'client_id'         => env('PAYPAL_SANDBOX_CLIENT_ID', 'AQtPTJiu7DE_Nww4uJgxXZ_iNzvcNOFZOiRO1ArKwxdPm14wBrwx-3E1ihlX0EkR-uxgTG_j4SbBf8q8'),
        'client_secret'     => env('PAYPAL_SANDBOX_CLIENT_SECRET', 'EDJ-e04z5jo6XVNXjD-lVDv8bZzqnPWD1r7iJzOKuCKiPoX50SAPtyjpS1pGZNsf-dBhLUqUonainmli'),
        'app_id'            => 'APP-80W284485P519543T',
    ],

    'live' => [
        'client_id'         => env('PAYPAL_LIVE_CLIENT_ID', ''),
        'client_secret'     => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
        'app_id'            => '',
    ],

    'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'),
    'currency'       => env('PAYPAL_CURRENCY', 'EUR'),
    'notify_url'     => env('PAYPAL_NOTIFY_URL', 'https://localhost:8000/trackinginfo_page'),
    'locale'         => env('PAYPAL_LOCALE', 'en_GB'),
    'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', false),
];
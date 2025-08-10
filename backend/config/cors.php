<?php

return [

    /*
    |--------------------------------------------------------------------------
    | CORS Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for Cross-Origin Resource Sharing
    | or "CORS". This determines which origins are allowed to access your
    | application via HTTP requests from different domains.
    |
    */

    'paths' => ['api/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://localhost:8080'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,
];

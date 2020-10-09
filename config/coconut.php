<?php

return [
    
    'token' => env('COCONUT_API_TOKEN'),

    's3' => [
        'access_key' => env('S3_KEY'),
        'secret_key' => env('S3_SECRET'),
        'bucket' => env('S3_BUCKET'),
    ]
];
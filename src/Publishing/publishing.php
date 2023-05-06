<?php declare(strict_types=1);

return [
    'twitter' => [
        'driver' => env('PUBLISHING_TWITTER_DRIVER', 'array'),

        'oauth2' => [
            'consumer_key' => env('PUBLISHING_TWITTER_CONSUMER_KEY'),
            'consumer_secret' => env('PUBLISHING_TWITTER_CONSUMER_SECRET'),
            'access_token' => env('PUBLISHING_TWITTER_ACCESS_TOKEN'),
            'access_token_secret' => env('PUBLISHING_TWITTER_ACCESS_TOKEN_SECRET'),
        ],
    ],
];

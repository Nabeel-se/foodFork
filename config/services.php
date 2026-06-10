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

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'spoonacular' => [
        'key' => env('SPOONACULAR_API_KEY'),
        'endpoint' => env('SPOONACULAR_ENDPOINT', 'https://api.spoonacular.com/recipes/complexSearch'),
        'default_count' => (int) env('SPOONACULAR_DEFAULT_COUNT', 25),
        'max_offset' => (int) env('SPOONACULAR_MAX_OFFSET', 500),
    ],

    'embeddings' => [
        'enabled' => (bool) env('EMBEDDINGS_ENABLED', true),
        'driver' => env('EMBEDDINGS_DRIVER', 'local'),
        'local_dimensions' => (int) env('EMBEDDINGS_LOCAL_DIMENSIONS', 256),
    ],

    'openai' => [
        'key' => env('OPENAI_API_KEY'),
        'enable_semantic_search' => (bool) env('OPENAI_ENABLE_SEMANTIC_SEARCH', false),
        'embedding_model' => env('OPENAI_EMBEDDING_MODEL', 'text-embedding-3-small'),
        'embedding_endpoint' => env('OPENAI_EMBEDDING_ENDPOINT', 'https://api.openai.com/v1/embeddings'),
        'timeout' => (int) env('OPENAI_TIMEOUT', 15),
    ],

];

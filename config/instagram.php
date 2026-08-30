<?php

return [
    'graph_version' => env('INSTAGRAM_GRAPH_VERSION', 'v21.0'),
    'cache_ttl' => (int) env('INSTAGRAM_CACHE_TTL', 3600),
    'posts_limit' => (int) env('INSTAGRAM_POSTS_LIMIT', 12),
    'scopes' => [
        'instagram_business_basic',
    ],
];

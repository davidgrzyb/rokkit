<?php

return [
    'default_domain' => env('DEFAULT_DOMAIN'),
    'advertisement_storage_directory' => env('ADVERTISEMENT_STORAGE_DIRECTORY'),
    
    'unavailable_slugs' => [
        'dashboard',
        'links',
        'links/create',
        'links/store',
        'links/update',
        'domains',
        'domains/create',
        'domains/store',
        'domains/delete',
        'account',
        'account/update',
        'account/upgrade',
        'account/downgrade',
        'ad'
    ],
];
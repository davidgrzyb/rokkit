<?php

return [
    'default_domain' => env('DEFAULT_DOMAIN'),

    'advertisement_storage_directory' => env('ADVERTISEMENT_STORAGE_DIRECTORY'),

    'extra_redirects' => [
        'title' => 'ROKKIT - Additional 1 million redirects.',
        'price' => 500,
        'redirects' => 1000000,
    ],

    'domain_instructions' => 'Rokkit requires custom domains to have CNAME records created pointing to rokk.it. This can be done by adding a CNAME record for www and non-www domains pointing to rokk.it in your domain registrars admin panel.',
    
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
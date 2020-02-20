<?php

return [
    'free' => [
        'name' => env('FREE_PLAN_NAME', 'Free Plan'),
        'limit' => env('FREE_PLAN_LIMIT', 5000),
    ],
    
    'pro' => [
        'name' => env('PRO_PLAN_NAME', 'Pro Plan'),
        'limit' => env('PRO_PLAN_LIMIT', 250000),
        'stripe_plan_id' => env('STRIPE_PRO_PLAN_ID'),
    ],
];
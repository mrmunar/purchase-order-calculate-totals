<?php

return [
    'cartoncloud_demo' => [
        'purchase_orders' => [
            'url' => env('CARTONCLOUD_DEMO_PURCHASE_ORDERS_URL', 'https://api.cartoncloud.com.au/CartonCloud_Demo/PurchaseOrders'),
            'username' => env('CARTONCLOUD_DEMO_USERNAME', 'interview-test@cartoncloud.com.au '),
            'password' => env('CARTONCLOUD_DEMO_PASSWORD', 'test123456'),
        ]
    ],
];

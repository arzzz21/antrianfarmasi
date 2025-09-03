<?php

return [
    'base_url' => env('EKLAIM_BASE_URL', 'http://localhost:8181/ws.php'),

    'user_key' => env('EKLAIM_USER_KEY', 'your_user_key'),

    'rs_id' => env('EKLAIM_RS_ID', 'your_rs_id'),

    'secret_key' => env('EKLAIM_SECRET_KEY', 'your_secret_key'), // kalau dipakai

    // Jika perlu headers tambahan
    'headers' => [
        'Content-Type' => 'application/x-www-form-urlencoded',
        // 'X-rs-id' => env('EKLAIM_RS_ID', 'your_rs_id'), // jika diperlukan
    ],
];

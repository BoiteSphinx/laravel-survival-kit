<?php

return [
    'default_user' => [
        'name' => env('DEFAULT_USER_NAME', 'Test'),
        'email' => env('DEFAULT_USER_EMAIL', 'test@example.com'),
    ],
    'send_email' => env('SEND_EMAIL', false),
];

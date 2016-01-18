<?php
return [
    'database' => [
        'engine' => 'pdo',
        'providers' => [
            'json' => [
                'path' => ROOT_DIR . 'internetBanking' . DS,
            ],
            'pdo' => [
                'host' => 'mysql:host=localhost;dbname=internetbanking',
                'user' => 'root',
                'pass' => ''
            ]
        ]
    ]
];
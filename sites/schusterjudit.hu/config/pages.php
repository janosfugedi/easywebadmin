<?php
// config/pages.php
return [
    '/' => [
        'theme' => 'default',
        'regions' => [
            'hero' => [1],
            'content' => [2, 3],
            'footer' => [4]
        ]
    ],

    '/biohacking' => [
        'theme' => 'default',
        'regions' => [
            'content' => [3],
            'footer' => [4]
        ]
    ]
];

<?php
// config/pages.php
return [
    '/' => [
        'theme' => 'default',
        'regions' => [
            'hero' => [1],
            'content' => [2, 3, 4],
            'footer' => [5]
        ]
    ],

    '/biohacking' => [
        'theme' => 'default',
        'regions' => [
            'content' => [3],
            'footer' => [5]
        ]
    ],
    '/test' => [
        'theme' => 'default',
        'view' => 'pages.test'
    ]
];

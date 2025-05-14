<?php
return [
        'header' => [],
        'hero' => [
            [
                'type' => 'hero',
                'data' => [
                    'title' => 'Összhangban a belső világoddal',
                    'subtitle' => 'Biohacking, energiamenedzsment, teljesítményoptimalizálás',
                    'image' => '/images/hero-bg.jpg',
                    'cta_text' => 'Töltsd ki a tesztet',
                    'cta_link' => '/teszt'
                ]
            ]
        ],

        'content' => [
            [
                'type' => 'about-intro',
                'data' => [
                    'text' => 'Gyermekkorom óta életem része a sport és a belső egyensúly keresése. A biohacking által megtanultam, hogyan támogassam a testem működését egyszerű eszközökkel és módszerekkel.'
                ]
            ],
            [
                'type' => 'method',
                'data' => [
                    'items' => [
                        'Alvásoptimalizálás',
                        'Táplálkozási beállítások',
                        'Stresszcsökkentés',
                        'Légzéstechnikák',
                        'Digitális eszközök használata'
                    ]
                ]
            ]
        ],

        'footer' => [
            [
                'type' => 'footer',
                'data' => [
                    'profile_image' => '/profile.png',
                    'name' => 'Schuster Judit',
                    'subtitle' => 'Biohacker Miskolc',
                    'note' => 'International Association of Biohackers tagja',
                    'address' => '3527 Miskolc, Bajcsy Zsilinszky u. 17',
                    'phone' => '+36 30 824 69 80',
                    'email' => 'info@schusterjudit.hu',
                    'service' => 'Online tanácsadás',
                    'form_enabled' => true,
                    'form_action' => '#'
                ]
            ]
        ]
];

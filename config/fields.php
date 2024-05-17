<?php

use Kirby\Toolkit\Date;

return [
    'openinghours' => [
        'props' => [
            'default' => function ($default = []) {
                return [
                    'label' => null,
                    'daterange' => [
                        'start' => Date::now()->toString(),
                        'end' => Date::now()->toString()
                    ],
                    'weekdays' => [
                        'mo' => null, // Monday
                        'tu' => null, // Tuesday
                        'we' => null, // Wednesday
                        'th' => null, // Thursday
                        'fr' => null, // Friday
                        'sa' => null, // Saturday
                        'su' => null, // Sunday
                    ],
                    ...$default
                ];
            },
            'value' => function ($value = null) {
                return Yaml::decode($value);
            }
        ]
    ],
    'weekdays' => [
        'props' => [
            'default' => function ($default = []) {
                return [
                    'mo' => null, // Monday
                    'tu' => null, // Tuesday
                    'we' => null, // Wednesday
                    'th' => null, // Thursday
                    'fr' => null, // Friday
                    'sa' => null, // Saturday
                    'su' => null, // Sunday
                    ...$default
                ];
            },
            'value' => function ($value = null) {
                return Yaml::decode($value);
            }
        ]
    ],
    'daterange' => [
        'props' => [
            'default' => function ($default = []) {
                return [
                    'start' => null,
                    'end' => null,
                    ...$default
                ];
            },
            'value' => function ($value = null) {
                return Yaml::decode($value);
            }
        ]
    ]
];
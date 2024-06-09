<?php

namespace Zephir\Openinghours\Helpers;
use Zephir\Openinghours\Models\Weekday;

class Formatting {

    public static $dayLabels = [
        'mo' => 'Montag',
        'tu' => 'Dienstag',
        'we' => 'Mittwoch',
        'th' => 'Donnerstag',
        'fr' => 'Freitag',
        'sa' => 'Samstag',
        'su' => 'Sonntag'
    ];

    public static $dayOrder = [
        'mo' => 0,
        'tu' => 1,
        'we' => 2,
        'th' => 3,
        'fr' => 4,
        'sa' => 5,
        'su' => 6
    ];

    public static function getDayName(Weekday $day) {
        return self::$dayLabels[$day->getDayCode()];
    }

    public static function getDayIndex(Weekday $day) {
        return self::$dayOrder[$day->getDayCode()];
    }

}
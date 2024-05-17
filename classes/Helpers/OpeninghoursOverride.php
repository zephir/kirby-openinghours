<?php

namespace Zephir\Openinghours\Helpers;

use Kirby\Cms\App;

class OpeninghoursOverride {

    public static function get() {
        $openinghours = self::getRaw();

        var_dump($openinghours);
    }

    public static function getRaw() {
        return App::instance()->site()->openinghoursOverride()->toObject()->toArray();
    }

}
<?php

use Zephir\Openinghours\Helpers\Openinghours;
use Zephir\Openinghours\Helpers\OpeninghoursOverride;

?>

<strong>Standard Öffnungszeiten</strong>

<pre>
    <?php var_dump(Openinghours::getRaw()); ?>
</pre>

<strong>Spezielle Öffnungszeiten</strong>

<pre>
    <?php var_dump(OpeninghoursOverride::getRaw()); ?>
</pre>
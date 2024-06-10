<?php

use Kirby\Toolkit\Date;
use Kirby\Toolkit\Str;
use Zephir\Openinghours\Helpers\Openinghours;
use Zephir\Openinghours\Helpers\Formatting;
use Zephir\Openinghours\Models\Openinghours as OpeninghoursModel;

$o = new OpeninghoursModel();

?>

<?php foreach ($o->getOpeninghours() as $openinghour): ?>
    <?php if ($openinghour->isHidden()) continue; ?>

    <h3>
        <?php if ($openinghour->isDefault() && $openinghour->isActive()): ?>
            Aktuell
        <?php elseif ($openinghour->isDefault()): ?>
            Normale Öffnungszeiten
        <?php else: ?>
            <?= $openinghour->getLabel() ? $openinghour->getLabel() : '' ?>
        <?php endif; ?>
    </h3>

    <?php if (!$openinghour->isDefault()): ?>
        <?php
            $start = $openinghour->getStartDate('E dd.MM.Y');
            $end = $openinghour->getEndDate('E dd.MM.Y');
        ?>

        <?php if ($start === $end): ?>
            <?= $start ?>
        <?php else: ?>
            <?= $start ?> bis <?= $end ?>
        <?php endif; ?>
    <?php endif; ?>

    <div style="margin-top: 10px;">
        <?php foreach ($openinghour->getHumanReadable() as $hr): ?>
            <div>
                <strong><?= $hr['weekdays'] ?></strong><br />
                <?= $hr['time'] ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>
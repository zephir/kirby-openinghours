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
        <?= ($openinghour->isActive() ? 'Aktuelle ' : ($openinghour->isDefault() ? 'Standard ' : ''))
            . 'Öffnungszeiten' .
            ($openinghour->getLabel() ? (': ' . $openinghour->getLabel()) : '')
        ?>
    </h3>

    <strong>
        <?php if (!$openinghour->isDefault()): ?>
            <?php
                $start = $openinghour->getStartDate('E, d.m.Y');
                $start = substr_replace($start, '', strpos($start, '.'), 1);

                $end = $openinghour->getEndDate('E, d.m.Y');
                $end = substr_replace($end, '', strpos($end, '.'), 1);
            ?>

            <?php if ($start === $end): ?>
                <?= $start ?>
            <?php else: ?>
                <?= $start ?> - <?= $end ?>
            <?php endif; ?>
        <?php endif; ?>
    </strong>

    <div style="margin-top: 10px;">
        <?php foreach ($openinghour->getHumanReadable() as $hr): ?>
            <div>
                <strong><?= $hr['weekdays'] ?></strong><br />
                <?= $hr['time'] ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>
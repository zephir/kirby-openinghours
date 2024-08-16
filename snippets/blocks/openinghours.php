<?php

use Zephir\Openinghours\Models\Openinghours as OpeninghoursModel;

$o = new OpeninghoursModel();

?>

<?php foreach ($o->getOpeninghours() as $openinghour): ?>
    <?php if ($openinghour->isHidden()) continue; ?>

    <?php if (!$openinghour->isDefault()): ?>
        <h3 style="margin-top: 2.5em">
                <?= $openinghour->getLabel() ? $openinghour->getLabel() : '' ?>
        </h3>
    <?php endif; ?>

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
<?php

use Zephir\Openinghours\Models\Openinghours as OpeninghoursModel;

$o = new OpeninghoursModel();

$month = null;

?>

<div class="calendar">
    <?php foreach ($o->getSpecialOpeninghours() as $openinghour): ?>
        <?php if ($openinghour->getDate('M') != $month): ?>
            <?php $month = $openinghour->getDate('M'); ?>
            <div class="calendar__month" colspan="3"><?= $openinghour->getDate('MMMM yyyy') ?></div>
        <?php endif; ?>
        <div class="calendar__datetime">
            <span><?= $openinghour->getDate('E dd.MM.') ?></span>
            <span><?= $openinghour->isClosed() ? 'geschlossen' : $openinghour->getFormattedTime() ?></span>
        </div>
        <div class="calendar__title">
            <?= $openinghour->getLabel() ?>
        </div>
    <?php endforeach; ?>
</div>
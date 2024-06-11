<?php

namespace Zephir\Openinghours\Models;

use DateInterval;
use Kirby\Cms\App;
use Kirby\Toolkit\Date;
use Zephir\Openinghours\Helpers\Daterange;

class Openinghours {

    /**
     * @var Openinghour[]
     */
    protected array $openinghours = [];

    /**
     * @var SpecialOpeninghour[]
     */
    protected array $specialOpeninghours = [];

    public function __construct()
    {
        $this->setOpeninghours(App::instance()->site()->openinghours()->toObject()->toArray());
        $this->setSpecialOpeninghours(App::instance()->site()->specialOpeninghours()->toObject()->toArray());
    }

    public function setOpeninghours(array $openinghours)
    {
        $openinghours = array_filter(
            array_map(function($openinghour) {
                $openinghour = $openinghour['openinghours'];

                $openinghour['default'] = isset($openinghour['default']) && $openinghour['default'] === true;

                // If "default" is true, do not skip item
                // If "default" is false and daterange->start or daterange->end is not set, skip item
                // The array properties might not exist, so we need to check if they are set
                if ($openinghour['default'] === false) {
                    if (!isset($openinghour['daterange']['start']) || !isset($openinghour['daterange']['end'])) {
                        return false;
                    }
                }

                $daterange = null;

                if (!$openinghour['default']) {
                    $daterange = new Daterange(
                        new Date($openinghour['daterange']['start']),
                        new Date($openinghour['daterange']['end'])
                    );
                }

                // If the openinghour is not the default openinghour and the daterange is in the past, skip Item
                if (!$openinghour['default'] && $daterange->getEndDate()->isBefore((new Date())->floor('day'))) {
                    return false;
                }

                return new Openinghour(
                    $openinghour['weekdays'],
                    $openinghour['default'] ?? false,
                    $openinghour['label'] ?? null,
                    $daterange,
                );
            }, $openinghours),
            fn($item) => $item !== false
        );

        // Map the $openinghours array
        // an change isActive to true if:
        // - the openinghour is the default openinghour
        // - the openinghour is not the default openinghour, but the current date is within the daterange
        $openinghours = array_map(function($openinghour) {
            if ($openinghour->isDefault() || $openinghour->getDateRange()->includes(new Date())) {
                $openinghour->setIsActive(true);
            }

            return $openinghour;
        }, $openinghours);

        // Identify all active indexes
        $activeIndexes = array_keys(array_filter($openinghours, fn($hour) => $hour->isActive()));

        // Ensure only the last active entry remains active if there are multiple
        foreach ($activeIndexes as $index) {
            if ($index !== end($activeIndexes)) {
                $openinghours[$index]->setIsActive(false);
            }
        }

        // Sort the opening hours by isActive, default, and daterange
        usort($openinghours, function($a, $b) {
            return ($b->isActive() ?? false) <=> ($a->isActive() ?? false)
                ?: ($b->isDefault() ?? false) <=> ($a->isDefault() ?? false)
                ?: ($a->getDateRange()->getStartDate() ?? null) <=> ($a->getDateRange()->getStartDate() ?? null);
        });

        $this->openinghours = $openinghours;

        return $this;
    }

    public function setSpecialOpeninghours(array $openinghours)
    {
        $openinghours = array_filter(
            array_map(function($openinghour) {
                $isClosed = $openinghour['closed'] === 'true' ?? false;

                $date = new Date($openinghour['date']);

                if ($date->isBefore((new Date())->floor('day'))) {
                    return false;
                }

                return new SpecialOpeninghour(
                    $openinghour['label'],
                    $date,
                    $isClosed ? [] : [
                        $openinghour['timeblock1'],
                        $openinghour['timeblock2']
                    ],
                    $isClosed
                );
            }, $openinghours),
            fn($item) => $item !== false
        );

        // Sort by date
        usort($openinghours, function($a, $b) {
            return $a->getDate() <=> $b->getDate();
        });

        $this->specialOpeninghours = $openinghours;
    }

    /**
     * @return Openinghour|null
     */
    public function getActiveOpeninghour()
    {
        if (empty($this->openinghours)) {
            return null;
        }

        return $this->openinghours[array_search(true, array_map(fn($oh) => $oh->isActive(), $this->openinghours))];
    }

    /**
     * @return SpecialOpeninghour|null
     */
    public function getActiveSpecialOpeninghour()
    {
        if (empty($this->specialOpeninghours)) {
            return null;
        }

        return $this->specialOpeninghours[array_search(true, array_map(fn($oh) => $oh->isActive(), $this->specialOpeninghours))];
    }

    /**
     * @return Weekday|SpecialOpeninghour|false
     */
    public function getToday()
    {
        $openinghour = $this->getActiveOpeninghour();
        $specialOpeninghour = $this->getActiveSpecialOpeninghour();

        if ($specialOpeninghour) {
            return $specialOpeninghour;
        }

        if (!$openinghour) {
            return false;
        }

        return $openinghour->getWeekdays()->getToday();
    }

    /**
     * @return Openinghour[]
     */
    public function getOpeninghours(): array
    {
        return $this->openinghours;
    }

    /**
     * @return SpecialOpeninghour[]
     */
    public function getSpecialOpeninghours(): array
    {
        return $this->specialOpeninghours;
    }

}
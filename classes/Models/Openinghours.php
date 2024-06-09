<?php

namespace Zephir\Openinghours\Models;
use DateInterval;
use DatePeriod;
use Kirby\Cms\App;
use Kirby\Toolkit\Date;
use Zephir\Openinghours\Helpers\Daterange;

class Openinghours {

    /**
     * @var Openinghour[]
     */
    protected array $openinghours = [];

    /**
     * @var Openinghour[]
     */
    protected array $specialOpeninghours = [];

    /**
     * @param Openinghour[] $openinghours
     */
    public function __construct()
    {
        $this->setOpeninghours(App::instance()->site()->openinghours()->toObject()->toArray());
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

                if ($openinghours[$index]->isDefault()) {
                    // $openinghours[$index]->setIsHidden(true);
                }
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

    /**
     * @return Openinghour
     */
    public function getActiveOpeninghour()
    {
        return $this->openinghours[array_search(true, array_map(fn($oh) => $oh->isActive(), $this->openinghours))];
    }

    /**
     * @return Weekday|false
     */
    public function getToday()
    {
        $openinghour = $this->getActiveOpeninghour();

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

}
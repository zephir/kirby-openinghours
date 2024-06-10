<?php

namespace Zephir\Openinghours\Models;
use Zephir\Openinghours\Helpers\Formatting;

class Weekdays {

    /**
     * @var Weekday[]
     */
    protected array $weekdays = [];

    /**
     * @param Weekday[] $weekdays
     */
    public function __construct(array $weekdays)
    {
        $this->setWeekdays($weekdays);
    }

    /**
     * @return array
     */
    public function getGrouped()
    {
        // Initialize an empty array to store the grouped weekdays
        $grouped = [];

        $weekdays = $this->weekdays;

        // Initialize variables to keep track of the previous time ID and the current group index
        $prevTimeId = null;
        $groupIndex = 0;

        // Sort weekdays so closed days are last and all other days are sorted by day index
        usort($weekdays, function($a, $b) {
            return $a->isClosed() <=> $b->isClosed()
                ?: Formatting::getDayIndex($a) <=> Formatting::getDayIndex($b);
        });

        // Iterate over each weekday
        foreach ($weekdays as $day) {
            // Determine the time ID for the current day
            // If the day is closed, the time ID is 'closed'
            // Otherwise, the time ID is a string of start-end times for each time block
            $timeId = $day->isClosed() ? 'closed' : $day->getFormattedTime();

            // If the time ID has changed, increment the group index
            if ($prevTimeId !== $timeId) {
                $groupIndex++;
            }

            // Initialize a new group if it doesn't exist
            if (!isset($grouped[$groupIndex])) {
                $grouped[$groupIndex] = [];
            }

            // Add the current day to the current group
            $grouped[$groupIndex][] = $day;

            // Update the previous time ID to the current time ID
            $prevTimeId = $timeId;
        }

        // Return the grouped weekdays
        return $grouped;
    }

    public function getHumanReadable()
    {
        $hr = [];

        $groupedWeekdays = $this->getGrouped();

        foreach ($groupedWeekdays as $weekdays) {
            $entry = [
                'weekdays' => null,
                'time' => $weekdays[0]->isClosed() ? 'geschlossen' : $weekdays[0]->getFormattedTime(),
            ];

            if (count($weekdays) >= 4) {
                $entry['weekdays'] = Formatting::getDayName($weekdays[0]) . ' bis ' . Formatting::getDayName($weekdays[count($weekdays) - 1]);
            } else if (count($weekdays) === 3) {
                $entry['weekdays'] = Formatting::getDayName($weekdays[0]) . ', ' . Formatting::getDayName($weekdays[1]) . ' und ' . Formatting::getDayName($weekdays[2]);
            } else if (count($weekdays) === 2) {
                $entry['weekdays'] = Formatting::getDayName($weekdays[0]) . ' und ' . Formatting::getDayName($weekdays[1]);
            } else {
                $entry['weekdays'] = Formatting::getDayName($weekdays[0]);
            }

            $hr[] = $entry;
        }

        return $hr;
    }

    /**
     * @return Weekday|false
     */
    public function getToday()
    {
        $today = array_filter($this->weekdays, fn($weekday) => $weekday->isToday());
        return reset($today);
    }

    /**
     * @param array $weekdays
     */
    public function setWeekdays($weekdays)
    {
        $this->weekdays = array_filter(
            array_map(function($weekday, $dayCode) {
                if (!$weekday) {
                    return null;
                }

                $wd = new Weekday(
                    $dayCode,
                    $weekday['closed'],
                    [
                        $weekday['timeblock1'],
                        $weekday['timeblock2']
                    ]
                );

                // Check if weekday is valid
                if (empty($wd->getTimeblocks()) && !$wd->isClosed()) {
                    return null;
                }

                return $wd;
            }, $weekdays, array_keys($weekdays)),
            fn($o) => $o !== null
        );

        return $this;
    }

    public function getAll()
    {
        return $this->weekdays;
    }
}